<?php

namespace App\Controllers\GenerateReport;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductionFormatModel;
use FPDF;

class ListsProduction extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlOrder = new OrderModel();
        $this->mdlFormatProduction = new ProductionFormatModel();
    }
    public function generateListProduction()
    {
        $id_order = $this->request->getPost('id_order');
        $id_line_production = $this->request->getPost('line_production');
        //consulta del pedido
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "EL PEDIDO NO EXITE";
        }
        if (!$order->isProduction()) {
            echo "EL PEDIDO NO ESTA EN PRODUCCION NO SE PUEDE IMPRIMIR ROTULO";
            return;
        }
        if (!$this->mdlFormatProduction->getProductionFormat($id_order, $id_line_production)) {
            echo "NO EXITE EL FORMATO DE PRODUCCION";
            return;
        }

        $pdf = new ListProduction('P', 'mm', array(215, 280));
        //Establecemos el margen inferior:
        $pdf->SetAutoPageBreak(true, 8);
        $pdf->AddPage();



        //TABLA DE TODO EL PEDIDO

        //Cuerpo
        switch ($id_line_production) {
            case 1:
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $pdf->SetFont('Arial', '', 12);
                $numrow = 1;
                foreach ($order->getDetailListShoes() as $row) {
                    $pdf->Row([
                        $numrow,
                        utf8_decode($row['reference_num']),
                        utf8_decode($row['name_reference']),
                        utf8_decode($row['name_size']),
                        utf8_decode($row['name_product']),
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                    ], 7, true);
                    $numrow += 1;
                }
                break;
            case 2:
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C', 'C', 'C', 'C', 'C', 'C'));
                $pdf->SetFont('Arial', '', 12);
                $numrow = 1;
                foreach ($order->getDetailListClothes() as $row) {
                    $pdf->Row([
                        $numrow,
                        utf8_decode($row['reference_num']),
                        utf8_decode($row['name_reference']),
                        utf8_decode($row['name_size']),
                        utf8_decode($row['name_product']),
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                    ], 7, true);
                    $numrow += 1;
                }
                break;
            default:
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C'));
                $pdf->SetFont('Arial', '', 12);
                $numrow = 1;
                foreach ($order->getDetailListByLineProduction($id_line_production) as $row) {
                    $pdf->Row([
                        $numrow,
                        utf8_decode($row['reference_num']),
                        utf8_decode($row['name_reference']),
                        utf8_decode($row['name_size']),
                        utf8_decode($row['name_product']),
                        utf8_decode($row['observation']),
                        '',
                    ], 7, true);
                    $numrow += 1;
                }
                break;
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

class ListProduction extends CustomPDF
{
    // Page header
    function Header()
    {
        //modelos
        $mdlFormatProduction = new ProductionFormatModel();
        $mdlorder = new OrderModel();

        // Logo
        $this->Image('img/corporative/logopera.png', 178, 10, 25);

        //datos
        $id_order = $_POST['id_order'];
        $id_line_production = $_POST['line_production'];

        //linea de produccion y pedido
        $formatProduction = $mdlFormatProduction->getProductionFormat($id_order, $id_line_production);
        $order = $mdlorder->find($id_order);

        $this->SetFont('Arial', 'B', 14);
        // Move to the right

        // Title
        $this->Cell(192, 4, utf8_decode('  FORMATO DE PRODUCCIÓN DE ' . $formatProduction['name_productionline']), 0, 1, 'C');
        $this->Cell(192, 8, utf8_decode($order->getTypeOrder()['name_typeoforder'] . ' ' . $order->id_order . '-' . $id_line_production), 0, 1, 'C');
        $customer = $order->getCustomer();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 5, utf8_decode(''), 0, 0, 'L');
        $this->Cell(65, 5, utf8_decode('CLIENTE: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($customer->name_customer . ' ' . $customer->surname_customer), 0, 1, 'R');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 5, utf8_decode(''), 0, 0, 'L');
        $this->Cell(65, 5, utf8_decode('DESTINO: '), 0, 0, 'L');
        $infoAdress = $order->getInfoAdress();
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($infoAdress['name_city'] . ' - ' . $infoAdress['name_department']), 0, 1, 'R');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 5, utf8_decode(''), 0, 0, 'L');
        $this->Cell(65, 5, utf8_decode('FECHA DE CREACIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($order->created_at_order), 0, 1, 'R');
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(10, 5, utf8_decode(''), 0, 0, 'L');
        $this->Cell(65, 4,  utf8_decode('FECHA DE PRODUCCIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($formatProduction['date_production']), 0, 1, 'R');


        $this->Ln(5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(195, 4, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 1, 'C');
        $this->Ln(2);

        switch ($id_line_production) {
            case 1:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 50, 12, 40, 35, 5, 5, 5, 5, 5, 5, 5));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('Observación'), 'S', 'T', 'A', 'G', 'B', 'M', 'C'], 7, true);
                break;
            case 2:
                //encabezado de la tabla
                $this->SetWidths(array(8, 10, 50, 15, 40, 11, 11, 11, 11, 11, 11, 11));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', 'Subl', 'File', 'Caus', 'Coll', 'Marq', 'Cali', 'Bols'], 7, true);
                break;
            default:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 50, 20, 45, 40, 15,));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('Observación'), 'Check'], 7, true);
                break;
        }
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
