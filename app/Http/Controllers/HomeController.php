<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Events\OrderisCreated;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date=date("Y-m-d");
        $cid=null;
        $message='';
        if(isset($_GET["date"]))
        {
            $date=$_GET["date"];
        }
        
        $message="Product order summary for ".date("d-m-Y ,D",strtotime($date));
        
        
        if(!isset($_GET["end_date"]))
        {
            $results = DB::select("SELECT p.name,sum(op.count) as pcount ,p.id as pid,p.product_number as code,of.name as of_name FROM `order_products` 
            op inner join orders o on o.id=op.order_id inner join products p on p.id=op.product_id inner join offerings of on of.id=p.offering_id
            where o.date='".$date."'   group by op.product_id,p.name,p.id,p.product_number,of_name order by p.product_number");
            
        }
        else
        {
            $endDate=$_GET["end_date"];
            $message=$message." - ".date("d-m-Y ,D",strtotime($endDate));
            $statement="SELECT p.name,sum(op.count) as pcount ,p.id as pid,p.product_number as code,of.name as of_name FROM `order_products` 
            op inner join orders o on o.id=op.order_id inner join products p on p.id=op.product_id inner join offerings of on of.id=p.offering_id
            where o.date BETWEEN '".$date."' AND '".$endDate."' ";
            
            if(isset($_GET["offering_id"]) && !empty($_GET["offering_id"]))
            {
                $statement=$statement." AND p.offering_id=".$_GET["offering_id"];
            }
            
            $statement=$statement."  group by op.product_id,p.name,p.id,p.product_number,of_name order by p.product_number";
            
            
            
             $results = DB::select($statement);
        }

        
        
        
       $data=[];
       $data["results"]=$results;
        $data["message"]=$message;

        return view('home.dashboard')->with('data',$data);
    }

    public function backupDB(){

        $order=Order::findOrFail(47);
        event(new OrderisCreated($order));
        exit;

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";
        $tables=[];
        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        

       
        $prep = "Tables_in_$DbName";
        foreach ($result as $res){
            $tables[] =  $res[0];
        }
        $tables=array_reverse($tables);
        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();

         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();

         for($count=0; $count<$total_row; $count++)
         {
          $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
          $table_column_array = array_keys($single_result);
          $table_value_array = array_values($single_result);
          $output .= "\nINSERT INTO $table (";
          $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
          $output .= "'" . implode("','", $table_value_array) . "');\n";
         }
        }

        $output=addslashes($output);
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
           header('Pragma: public');
           header('Content-Length: ' . filesize($file_name));
           ob_clean();
           flush();
           readfile($file_name);
           unlink($file_name);


}
}
