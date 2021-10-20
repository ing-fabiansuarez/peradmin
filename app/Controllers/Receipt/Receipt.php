<?php

namespace App\Controllers\Receipt;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\OrderModel;
use App\Models\ReceiptModel;
use Exception;

class Receipt extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->rulesvalidation = \Config\Services::validation();
        $this->mdlOrder = new OrderModel();
        $this->mdlBank = new BankModel();
        $this->mdlReceipt = new ReceiptModel();
    }

    public function index($id_order)
    {
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "EL PEDIDO NO EXITE";
            return;
        }
        return view('contents/receipt/view_receipt', [
            'banks' => $this->mdlBank->findAll(),
            'order' => $order,
            'receipts' => $order->getReceipts()
        ]);
    }

    public function create()
    {
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newReceipt')
        ))) {
            $cadena = '';
            foreach ($this->validator->getErrors() as $error) {
                $cadena .= '* ' . $error . '<br>';
            }
            echo $cadena;
            return;
        }

        //datos recibidos del formulario
        $id_order = $this->request->getPost('id_order');
        $date = $this->request->getPost('fecha');
        $approveNumber = $this->request->getPost('aprobacion');
        $value = $this->request->getPost('valor');
        $bank = $this->request->getPost('banco');
        $observation = $this->request->getPost('observacion');
        if ($observation == '') :
            $observation = null;
        endif;
        //------

        //validar si ya existe un recibo con el mismo numero de aprobacion
        if ($receipt = $this->mdlReceipt->where('approval_receipt', $approveNumber)->where('bank_id_bank', $bank)->first()) {
            return redirect()->back()->with('msg', [
                'title' => 'Ya esta registrado el pago',
                'body' => "Esta creado en el pedido " . $receipt['order_id'],
                'icon' => '<i class="icon fas fa-ban"></i>',
                'class' => 'alert-danger'
            ]);
        }
        $arrayFecha = explode('-', $date); //separa la fecha 
        $number =  $this->mdlReceipt->where("`date_receipt` LIKE '%" . $arrayFecha[0] . "-" . $arrayFecha[1] . "-%'")->countAllResults() + 1;
        //crear el consecutivo
        $consecutive = $arrayFecha[0] . '-' . $arrayFecha[1] . '-' . $number;

        //guardar la imagen y el pago
        $file = $this->request->getFile('voucher');
        if ($file->isValid() && !$file->hasMoved()) {
            //crea la carpeta donde se va a alojar el recibo si no existe
            $path = 'receipts/' . $arrayFecha[0] . '/' . $arrayFecha[1] . '/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            //se agrega la imagen
            $ext = '.' . $file->getClientExtension();
            $newName = $consecutive;
            $file->move($path, $newName . $ext);
            $filepath = $path . $newName . $ext;
            try {
                $Image = \Config\Services::image()->withFile($filepath);
            } catch (Exception $e) {
                //se elimina el archivo que se habia subido porque la imagen no es imagen
                unlink($filepath);

                return redirect()->back()->with('msg', [
                    'body' => 'Exception: ' . $e->getMessage(),
                    'title' => 'Hubo un error al tratar de guardar la imagen',
                    'icon' => '<i class="icon fas fa-ban"></i>',
                    'class' => 'alert-danger'
                ])->withInput();
            }
            $width_image = $Image->getFile()->origHeight;
            $height_image = $Image->getFile()->origWidth;
            $desired_width = 250;
            $Image->reorient()->resize($desired_width, ($width_image / $height_image) * $desired_width)->save($filepath);

            //se crea el registro en la base de datso
            $this->mdlReceipt->insert([
                'approval_receipt' => $approveNumber,
                'bank_id_bank' => $bank,
                'order_id' => $id_order,
                'value_receipt' => $value,
                'date_receipt' => $date,
                'description_receipt' => $observation,
                'consecutive_receipt' => $consecutive,
                'image_receipt' => $filepath,
                'created_by_receipt' => session()->get('cedula_employee'),
            ]);

            return redirect()->back()->with('msg', [
                'title' => 'Creado con Exito!',
                'body' => "El recibo fue creado con exito.",
                'icon' => '<i class="icon fas fa-check"></i>',
                'class' => 'alert-success'
            ]);
        } else {
            return redirect()->back()->with('msg', [
                'title' => 'No pudo ser Creado con Exito!',
                'body' => "El Archivo no es valido o ha sido movido",
                'icon' => '<i class="icon fas fa-ban"></i>',
                'class' => 'alert-danger'
            ]);
        }
    }
}
