<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB; 
use App\Models\Invoice;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
     {
        $curr= date('d-m-Y');
        $custom_date = strtotime($curr);
        $end_date = strtotime("+3 day", $custom_date);
        $due_date = strtotime("-1 day", $custom_date);
     
      // echo date('d-m-Y',$due_date);die;
         

        $remider_date= date('d-m-Y', $end_date);
        $overdue_date= date('d-m-Y', $due_date);
     
   $reminder_data=Invoice::where('invoice_due_date',$remider_date)	
   ->where('status','pending')	
   ->get();
  

   $last_date=Invoice::where('invoice_due_date',$curr)  
   ->where('status','pending')	
   ->get();


   $due=Invoice::where('invoice_due_date',$overdue_date) 	
   ->where('status','pending')	
   ->get();
		// echo '<pre>';print_r($due);die;
   
  // $last_date=Invoice::where('invoice_due_date',$curr)->get();

   
      if(isset($reminder_data)){
        // echo '<pre>';print_r($reminder_data);die;
     foreach($reminder_data as $invoice){
       //  echo $invoice->id;die;
   //   \Mail::raw('Hello World!sub', function($msg) {$msg->to('ajaykant.kanojiya@graffersid.com')->subject('Test  Email FOR SUB'); });
      //return response()->json(['reminder date  successfully.',$invoice]);

      DB::table('notification')->insert([
         'invoice_id'=>$invoice->id,
         'message'=>'after 3 days your last payment date',
         'status'=>0

      ]);

      DB::table('invoices')
      ->where('id',$invoice->id)
      ->update(['status' =>'Pending']);

     }

      }
      if(isset($last_date)){

     
     foreach($last_date as $invoice){
              
       //  \Mail::raw('Hello World!sub', function($msg) {$msg->to('ajaykant.kanojiya@graffersid.com')->subject('Test  Email FOR SUB'); });
        // echo 'mail send last';
        // return response()->json(['Last date successfully.',$invoice]);
        DB::table('notification')->insert([
         'invoice_id'=>$invoice->id,
         'message'=>'today your last payment date',
         'status'=>0

      ]);

      DB::table('invoices')
      ->where('id',$invoice->id)
      ->update(['status' =>'Pending']);


        }
     }

     if(isset($due)){

     
         foreach($due as $invoice){
                  
           //  \Mail::raw('Hello World!sub', function($msg) {$msg->to('ajaykant.kanojiya@graffersid.com')->subject('Test  Email FOR SUB'); });
            // echo 'mail send last';
            // return response()->json(['Last date successfully.',$invoice]);
            DB::table('notification')->insert([
               'invoice_id'=>$invoice->id,
               'message'=>'your payment over to due date',
               'status'=>0

            ]);

            DB::table('invoices')
            ->where('id',$invoice->id)
            ->update(['status' =>'Due']);
      
    
            }
         }
  
    
 }
}
