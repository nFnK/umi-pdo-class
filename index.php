<?php

include ("pdodb.php");
$crud = new CRUD();
$denemetb = $crud->select("deneme", "*", null, null, null, "0,5");
//($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
if(count($denemetb) > 0)
{
      echo '<table class="table table-bordered table-striped">
                        <tr>
                            <th>No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                        </tr>';

      $number = 1;
      foreach ($denemetb as $ic)
      {
            echo '<tr>
                <td>' . $number . '</td>
                <td>' . $ic['ekleyen'] . '</td>
                <td>' . $ic['baslik'] . '</td>
                <td>' . $ic['eklenme'] . '</td>
         
            </tr>';
            $number++;
      }
      echo '</table>';
} else
{
      echo '<tr><td colspan="6">Hata select</td></tr>';
}


// select end

echo "<hr />";


// deneme 2

// detay 2
echo "<hr />";
$detay = json_decode($crud->details("deneme", "*", "id=39", null, "0,5"));
echo $detay->ekleyen . "___" . $detay->baslik . "<hr />";

/* // insert // last
$crud->insert('deneme',array('ekleyen'=>'insertx','baslik'=>''.rand().'','onay'=>'2','ip'=>'212.22.22.2'));  
echo "<br />".  $crud->insertid();*/
$crud->update('deneme', 'id=42', array(
      'ekleyen' => 'upladık',
      'eklenme' => '2015-01-01 14:06:41',
      'baslik' => 'up ' . rand() . '',
      'onay' => '3',
      'ip' => '111.22.22.2'));
$sil = $crud->delete('deneme', array('ekleyen' => 'insertx', 'id' => '151'));
echo $crud->ok; // 1 or 0

?>