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
            echo "EL PEDIDO NO ESTA EN PRODUCCION NO SE PUEDE IMPRIMIR ROTULO";
            return;
        }

        //SE DECLARA LA CLASE DE PDF
        $pdf = new CustomPDF('P', 'mm', array(215, 280));
        $pdf->AddPage();
        // Imagen Fondo
        $pdf->Image('public/img/corporative/rotulo.png', 0, 0, 215);
        $pdf->SetFont('Arial', 'B', 17);

        $pdf->Cell(30, 85, '', 0, 1, 'C');

        $pdf->SetWidths(array(15, 50, 120));
        $pdf->SetAligns(array('L', 'L', 'L'));
        $customer = $order->getCustomer();
        $infoAdress = $order->getInfoAdress();

        $pdf->Row(['', 'Cliente:', $customer->name_customer . ' ' . $customer->surname_customer], 7);
        $pdf->Row(['', 'Documento:', $customer->numberidenti_customer], 7);
        $pdf->Row(['', 'Telefono:', $infoAdress['whatsapp_infoadress']], 7);
        $pdf->Row(['', 'Email:', $infoAdress['email_infoadress']], 7);
        $pdf->Row(['', 'Ciudad:', $infoAdress['name_city'] . ' - ' . $infoAdress['name_department']], 7);
        $pdf->Row(['', utf8_decode('Dirección:'), $infoAdress['home_infoadress'] . ' barrio ' . $infoAdress['neighborhood_infoadress']], 7);
        $pdf->Row(['', 'Transportadora:', $infoAdress['name_transporter']], 7);
        $pdf->Row(['', 'Detalle:', ''], 7);
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
}

/*************** Clase PDF_AutoPrint basandose en PDF_JavaScript *************/
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

    function Row($data, $altu)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $altu * $nb;
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
            //$this->Rect($x, $y, $w, $h);
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
