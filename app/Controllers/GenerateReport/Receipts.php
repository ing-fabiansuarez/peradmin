<?php

namespace App\Controllers\GenerateReport;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\OrderModel;
use App\Models\ReceiptModel;
use FPDF;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Receipts extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlOrder = new OrderModel();
        $this->mdlReceipt = new ReceiptModel();
        $this->mklBank = new BankModel();
    }
    public function generateReceipt($idBank, $approveNumber)
    {
        //consulta del pedido
        if (!$receipt =  $this->mdlReceipt->where('approval_receipt', $approveNumber)->where('bank_id_bank', $idBank)->first()) {
            echo "EL RECIBO NO EXISTE";
            return;
        }
        if (!$order = $this->mdlOrder->find($receipt['order_id'])) {
            echo "NO SE ENCONTRO LA ORDEN";
            return;
        }
        $bank = $this->mklBank->find($receipt['bank_id_bank']);

        $customer = $order->getCustomer();
        $infoAdress = $order->getInfoAdress();

        //SE DECLARA LA CLASE DE PDF
        $pdf = new CustomPDF('P', 'mm', array(215, 280));
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(5, 5, 5);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        //ENCABEZADO
        //logo
        $pdf->Image('img/corporative/logo.png', 15, 5, 13);
        //voucher
        $pdf->Image(base_url($receipt['image_receipt']), 135, 15, 70);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, utf8_decode('N° ' . $receipt['consecutive_receipt']), 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(130, 3, utf8_decode('Recibo de caja'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(130, 3, utf8_decode('PeRa DK SAS - Nit 901060044-9'), 0, 1, 'C');
        $pdf->Cell(130, 3, utf8_decode('Pamplona Norte de Santander'), 0, 1, 'C');
        $pdf->Ln(3);
        //------
        //CUERPO
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(210, 144, 244);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(125, 5, utf8_decode('Información del cliente'), 0, 1, 'C', true);
        $pdf->Ln(1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Cell(5);
        $pdf->Cell(30, 4, utf8_decode($customer->getTypeDocument()['abbreviation_typeofidentification']), 0, 0, 'L');
        $pdf->Cell(85, 4, utf8_decode($customer->numberidenti_customer), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(30, 4, "NOMBRE", 0, 0, 'L');
        $pdf->Cell(85, 4, utf8_decode($customer->name_customer . ' ' . $customer->surname_customer), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(30, 4, "EMAIL", 0, 0, 'L');
        $pdf->Cell(85, 4, utf8_decode($infoAdress['email_infoadress']), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(30, 4, "TELEFONO", 0, 0, 'L');
        $pdf->Cell(85, 4, utf8_decode($infoAdress['whatsapp_infoadress']), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(30, 4, utf8_decode("DIRECCIÓN"), 0, 0, 'L');
        $pdf->Cell(85, 4, utf8_decode($infoAdress['home_infoadress'] . ' barrio ' . $infoAdress['neighborhood_infoadress']), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(30, 4, "CIUDAD", 0, 0, 'L');
        $pdf->Cell(85, 4, utf8_decode($infoAdress['name_city'] . ' - ' . $infoAdress['name_department']), 0, 1, 'L');

        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(210, 144, 244);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(125, 5, utf8_decode('Información de la consignación'), 0, 1, 'C', true);
        $pdf->Ln(1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Cell(5);
        $pdf->Cell(45, 4, utf8_decode("NÚMERO DE APROBACIÓN"), 0, 0, 'L');
        $pdf->Cell(70, 4, utf8_decode($receipt['approval_receipt']), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(45, 4, utf8_decode("FECHA DE CONSIGNACIÓN"), 0, 0, 'L');
        $pdf->Cell(70, 4, utf8_decode($receipt['date_receipt']), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(45, 4, utf8_decode("BANCO"), 0, 0, 'L');
        $pdf->Cell(70, 4, utf8_decode($bank['name_bank']), 0, 1, 'L');

        $pdf->Cell(5);
        $pdf->Cell(45, 4, utf8_decode("VALOR"), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(70, 4, '$ ' . number_format($receipt['value_receipt']), 0, 1, 'R');

        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 8);

        $pdf->SetFillColor(104, 104, 104);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(125, 5, 'Impreso por ' . session()->get('name_employee') . ' (' . session()->get('cedula_employee') . ') el ' . date("Y-m-d H:i:s"), 1, 1, 'C', true);
        $pdf->Ln(1);
        $pdf->Cell(125, 5, 'Elaborado por ' . $receipt['created_by_receipt'], 1, 1, 'C', true);
        //---------------

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('I', 'Recibo de Caja', true);
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

class ReceiptPDF extends CustomPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('img/corporative/logopera.png', 178, 10, 25);
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
