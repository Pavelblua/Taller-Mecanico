<?php

namespace transformers;

class toolsGrid
{
    private function getHead(array $col){
        $colName = null;
        
        foreach ($col as $cols){
            $colName .='<th scope="col">'.$cols.'</th>';
        }

        $head = '<thead><tr>';
        $head .= $colName;
        $head .= '</tr></thead>';

        return $head;
    }

    private function getBody(array $row, $colBold){
        $rowDetail = null;
        foreach ($row as $rows){
           $rowDetail .='<tr>';
           $count =0;
        foreach ($rows as $rowData){
                if($count < $colBold){
                    $rowDetail .='<th scope="row">'.$rowData.'</th>';
                } else {
                    $rowDetail .='<td>'.$rowData.'</td>';
                }
                $count++;
            }
            $rowDetail .='</tr>';
        }
        $body = '<tbody>';
        $body.= $rowDetail;
        $body .= '</tbody>'
        ;
        return $body;
    }

    public function getTable(array $col, array $row, $colBold){
        $table ='<table class="table table-bordered table-striped table-hover align-middle mb-0">';
        $table .= $this->getHead($col);
        $table .= $this->getBody($row, $colBold);
        $table .='</table>';

        return $table;
    }

}
