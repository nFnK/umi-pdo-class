<?php
define("dtype", "sqlite");
define("dbName", "dogsDb_PDO.sqlite");
define("dbHost", "");
define("dbUsername", "");
define("dbUserPassword", "");
define("dbport", "");
include ("pdodb.php");
$crud = new CRUD();
$denemetb = $crud->select("Dogs", "*", null, null, null, null);
//($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
if(count($denemetb) > 0)
{
      echo '<table class="table table-bordered table-striped">
                        <tr>
                            <th>Id.</th>
                            <th>Breed</th>
                            <th>Name</th>
                            <th>Age</th>
                        </tr>';

      foreach ($denemetb as $ic)
      {
            echo '<tr>
                <td>' . $ic['Id'] . '</td>
                <td>' . $ic['Breed'] . '</td>
                <td>' . $ic['Name'] . '</td>
                <td>' . $ic['Age'] . '</td>
         
            </tr>';
      }
      echo '</table>';
} else
{
      echo '<tr><td colspan="6">Hata select</td></tr>';
}


// select end

echo "<hr />";
$detay = json_decode($crud->details("Dogs", "*", "id=2", null, "0,1"));
echo $detay->Breed . "___" . $detay->Name . "--".$crud->ok. "<hr />";
echo "<hr />";
//$sil = $crud->delete('Dogs', array('id' => '7'));

$crud->insert('Dogs',array('Breed'=>rand(),'Name'=>''.rand().'','Age'=>'12'));  
echo "<br />".  $crud->insertid(). "--".$crud->ok."<hr />";