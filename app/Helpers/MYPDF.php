<?php

namespace App\Helpers;

use setasign\Fpdi\Tcpdf\Fpdi;

class MYPDF extends Fpdi
{
    public function ColoredTable($header, $data, $line_starts = 25): void
    {
        $this->Ln(5);
        // Colors, line width and bold font
        $this->SetFillColor(14, 128, 158);
        $this->SetTextColor(255);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        $this->setX($line_starts);
        // Header
        $w = array(55, 35, 35, 35, 30);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'R', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(242, 242, 242);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->setX($line_starts);
            $this->Cell($w[0], 8, 'اجمالي اتعاب تقييم ' . $row['type'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[1], 8, $row['number'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[2], 8, $row['price'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[3], 8, $row['tax'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[4], 8, $row['total'], 'LRB', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $collection_data = collect($data);
        $this->setX($line_starts);
        $this->Cell(array_sum($w)-$w[4], 8, 'اجمالي الاتعاب بالضريبة رقماً ', 'TLRB', 0, 'R', $fill);
        $this->Cell($w[4], 8, $collection_data->sum('total') . 'ريال ', 'TLRB', 0, 'R', $fill);

    }

    public function writeJustify($text, $linechar)
    {
        $textexploded   =   explode(" ",$text);                   // create array of words
        $lettercount    =   mb_strlen($text,'UTF-8');                       // Get total number of characters of the whole text
        $linesnum       =   $lettercount / $linechar;                    // divide number of characters over sensitivity number "how many letters per line"
        $whole          =   floor($linesnum);                       // before decimal
        $fraction       =   $linesnum - $whole;                      // decimal
        $last           =   $fraction * $linechar;                   // estimate number of characters of last line
        $last           =   $last - 3;                                  // refining

        if (    $lettercount >= $linechar   ) {                     // Proceed of text characters are more than one line limit
            $total = 0;
            for ($x = count($textexploded); $total < $last; $x--) {   // Start at the end of the words array
                $total += mb_strlen($textexploded[$x-1],'UTF-8');    // Estimate at what array word last line starts
            }

            $slice_position = array_search($x, array_keys($textexploded));  // determine the slice position of the original text
            $a1 = array_slice($textexploded, 0, $slice_position, true);     // Slice the first lines
            $a2 = array_slice($textexploded, $slice_position, count($textexploded), true);  //slice the last line
            $a1 = implode(" ",$a1);                                         // recombine words
            $a2 = implode(" ",$a2);                                         // recombine words

            $this->MultiCell(190, 0, '       '.$a1, 0, 'J', 0, 1, '', '', false, 2, false, true, 0, 'M');
            $this->Cell(0, 6, $a2, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        } else {
            $this->Cell(0, 6, $text, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        }
    }
}
