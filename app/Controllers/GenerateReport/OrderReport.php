<?php

namespace App\Controllers\GenerateReport;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use FPDF;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class OrderReport extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlOrder = new OrderModel();
    }
    public function generateRotulo($id_order)
    {
        //consulta del pedido
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "EL PEDIDO NO EXITE";
        }
        if (!$order->isProduction()) {
            return redirect()->to(base_url() . route_to('view_order'))->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'Alerta!',
                'body' => 'EL PEDIDO NO ESTA EN PRODUCCION NO SE PUEDE IMPRIMIR ROTULO.'
            ]);
        }

        //SE DECLARA LA CLASE DE PDF
        $pdf = new RotuloPDF('P', 'mm', array(215, 280));
        $pdf->AddPage();
        // Imagen Fondo
        $pdf->Image('img/corporative/rotulo.png', 0, 0, 215);
        
        $pdf->Cell(30, 75, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(0, 15, utf8_decode('N° '.$order->id_order), 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->SetWidths(array(15, 60, 120));
        $pdf->SetAligns(array('L', 'L', 'L'));
        $customer = $order->getCustomer();
        $infoAdress = $order->getInfoAdress();
        $pdf->Row(['', 'CLIENTE:', $customer->name_customer . ' ' . $customer->surname_customer], 7);
        $pdf->Row(['', 'DOCUMENTO:', $customer->numberidenti_customer], 7);
        $pdf->Row(['', 'TELEFONO:', $infoAdress['whatsapp_infoadress']], 7);
        $pdf->Row(['', 'EMAIL:', $infoAdress['email_infoadress']], 7);
        $pdf->Row(['', 'CIUDAD:', $infoAdress['name_city'] . ' - ' . $infoAdress['name_department']], 7);
        $pdf->Row(['', utf8_decode('DIRECCION:'), $infoAdress['home_infoadress'] . ' barrio ' . $infoAdress['neighborhood_infoadress']], 7);
        $pdf->Row(['', 'TRANSPORTADORA:', $infoAdress['name_transporter']], 7);
        $pdf->Row(['', 'DETALLE:', ''], 7);
        //seccion
        $pdf->SetWidths(array(50, 10, 60, 17));
        $pdf->SetAligns(array('L', 'L', 'L', 'R'));
        $pdf->SetFont('Arial', 'B', 13);
        $total = 0;
        foreach ($order->getCountEachProduct() as $row) {
            $total += $row['quantity'];
            $pdf->Row(['', '=>', utf8_decode($row['name_product']), $row['quantity']], 5);
        }
        $pdf->cell(60);
        $pdf->cell(60, 8, 'TOTAL', 'T', 0, 'R', 0);
        $pdf->cell(17, 8, $total, 'T', 1, 'R', 0);
        //seccion
        $pdf->SetFont('Arial', 'B', 17);
        $pdf->SetWidths(array(15, 45, 120));
        $pdf->SetAligns(array('L', 'L', 'L'));
        $pdf->Row(['', utf8_decode('Obsevación adicional:'), $order->info_order], 7);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }

    public function generateGeneralFormat($id_order)
    {
        //consulta del pedido
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "EL PEDIDO NO EXITE";
        }
        if (!$order->isProduction()) {
            return redirect()->to(base_url() . route_to('view_order'))->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'Alerta!',
                'body' => 'EL PEDIDO NO ESTA EN PRODUCCION NO SE PUEDE IMPRIMIR ROTULO.'
            ]);
            return;
        }

        $pdf = new GeneralFormatPDF('P', 'mm', array(215, 280));
        //Establecemos el margen inferior:
        $pdf->SetAutoPageBreak(true, 8);
        $pdf->AddPage();

        //TABLA DE TODO EL PEDIDO
        //Encabezado
        $pdf->SetWidths(array(10, 15, 45, 20, 40, 35, 30));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('observación'), 'Precio'], 7, true);
        //Cuerpo
        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C'));
        $pdf->SetFont('Arial', '', 12);

        $numrow = 1;
        foreach ($order->getDetailList() as $row) {
            $pdf->Row([
                $numrow,
                utf8_decode($row['reference_num']),
                utf8_decode($row['name_reference']),
                utf8_decode($row['name_size']),
                utf8_decode($row['name_product']),
                utf8_decode($row['observation']),
                utf8_decode('$ ' . number_format($row['pricesale_detailorder']))
            ], 7, true);
            $numrow += 1;
        }

        //------------------------------------------
        $pdf->AliasNbPages();
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
class CustomPDF extends FPDF
{
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data, $alt = 7, $border = false)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $alt * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            if ($border) {
                $this->Rect($x, $y - 1, $w, $h);
            }
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
        return $h;
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

class GeneralFormatPDF extends CustomPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('img/corporative/logopera.png', 178, 10, 25);
        // Arial bold 15
        $id_order = $_POST['id_order'];
        $mdlorder = new OrderModel();
        $order = $mdlorder->find($id_order);
        $this->SetFont('Arial', 'B', 14);
        // Move to the right

        // Title
        $this->Cell(192, 10, utf8_decode( 'FORMATO DEL PEDIDO N° ' . $order->id_order), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 12);

        $customer = $order->getCustomer();

        $this->Cell(75, 5, utf8_decode('CLIENTE: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($customer->name_customer . ' ' . $customer->surname_customer), 0, 1, 'R');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 5, utf8_decode('DESTINO: '), 0, 0, 'L');
        $infoAdress = $order->getInfoAdress();
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($infoAdress['name_city'] . ' - ' . $infoAdress['name_department']), 0, 1, 'R');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 5, utf8_decode('FECHA DE CREACIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($order->created_at_order), 0, 1, 'R');
        $ProductionFormats = $order->getProductionFormat();
        $this->SetFont('Arial', 'B', 12);

        if ($order->type_of_order_id == 1) {
            $this->Cell(55, 4,  utf8_decode('FORMATOS DE PRODUCCION: '), 0, 0, 'L');
            $this->SetFont('Arial', '', 9);
            foreach ($ProductionFormats as $row) {
                $this->Cell(40, 4, utf8_decode($row['order_id_order'] . '-' . $row['production_line_id_productionline']), 0, 0, 'R');
                $this->Cell(45, 4, utf8_decode($row['name_productionline']), 0, 0, 'L');
                $this->Cell(20, 4, utf8_decode($row['date_production']), 0, 1, 'R');
                $this->Cell(55, 4, '', 0, 0, 'L');
            }
        }
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(195, 4, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 1, 'C');
        $this->Ln(2);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(50, 10, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'C');
        $this->Cell(145, 10, 'Impreso por ' . session()->get('name_employee') . ' (' . session()->get('cedula_employee') . ') el ' . date("Y-m-d H:i:s"), 0, 0, 'C');
    }
}

class RotuloPDF extends CustomPDF
{
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(50, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
        $this->Cell(145, 10, 'Impreso el ' . date("Y-m-d H:i:s"), 0, 0, 'C');
    }
}
