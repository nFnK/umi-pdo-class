# PDO CRUD CLASSES FOR ALL DATABASES

You can use a simple way


Database List :+1:

 * mysql
 * sqlite
 * pgsql
 * dblib-> mssql



```php
<?php
define("dtype", "mysql");
define("dbName", "_pdo");
define("dbHost", "localhost");
define("dbUsername", "root");
define("dbUserPassword", "root");
define("dbport", "");
include ("pdodb.php");
$crud = new CRUD();

```
select all
```php
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
// select end
```

select one
```php
echo "<hr />";
$detay = json_decode($crud->details("deneme", "*", "id=39", null, "0,5"));
echo $detay->ekleyen . "___" . $detay->baslik . "--".$crud->ok. "<hr />";

// select end
```
insert
```php
$crud->insert('deneme',array('ekleyen'=>'insertx','baslik'=>''.rand().'','onay'=>'2','ip'=>'212.22.22.2'));  
echo "<br />".  $crud->insertid(). "--".$crud->ok."<hr />";
```
update
```php
$crud->update('deneme', 'id=42', array(
      'ekleyen' => 'upladık',
      'eklenme' => '2015-01-01 14:06:41',
      'baslik' => 'up ' . rand() . '',
      'onay' => '3',
      'ip' => '111.22.22.2'));
```
delete
```php
$sil = $crud->delete('deneme', array('ekleyen' => 'insertx', 'id' => '161'));
echo $crud->ok; // 1 or 0
```

