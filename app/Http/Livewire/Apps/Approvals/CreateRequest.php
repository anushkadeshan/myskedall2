<?php

namespace App\Http\Livewire\Apps\Approvals;

use App\Models\Approvals\Chat;
use App\Models\Approvals\Finance;
use App\Models\Approvals\Item;
use App\Models\Approvals\Level;
use DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Approvals\Request;
use App\Models\Approvals\SubType;

class CreateRequest extends Component
{
    use WithFileUploads;

    public $i = 0;
    public $inputs = [];
    public $step1 = false;
    public $step2 = false;
    public $step3 = false;

    public $is_draft = false;

    //request
    public $title;
    public $description;
    public $type = NULL;
    public $sub_type;
    public $due_date;
    public $limit_date;
    public $priority;
    public $level;
    public $status;

    //items
    public $name;
    public $value;
    public $details;
    public $reference_link;
    public $responsible_dept;
    public $payment_method;
    public $value_sum =0;

    //finance
    public $bank_id;
    public $agency;
    public $account;
    public $account_owner;
    public $cpf_cnpj;
    public $app_type;
    public $transaction_url;
    public $invoice;
    public $filename = [];

    public $types;
    public $subtypes = [];

    public $request_id;

    public $sender_id;
    public $message;
    public $is_liked;

    public $chats = [];
    public $levels;

    public $payment_methods = [];

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
        array_push($this->payment_method ,'Bank Transfer');
    }

    public function mount(){
        $this->types = collect();
        $this->subtypes = collect();

        $this->levels = Level::select('id','name')->where('group_id',session('group-id'))->get();

        if(session('request_id')){
            $this->chats = Chat::with(['user'])->where(['request_id' => session('request_id')])->get()->toArray();
        }
    }

    public function updatedValue(){
        $this->value_sum = array_sum($this->value);
    }

    public function updatedInvoice(){
        $this->filename = $this->invoice[$this->i]->getClientOriginalName();
    }

    public function updatedType($type){
        if (!is_null($type)) {
            $this->subtypes =  SubType::where('type_id', $this->type)->get();
            //dd($this->subtypes);
        }
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
        //dd($this->inputs);
    }

    public function PaymentMethod(){
        dd($this->payment_method);
    }

    public function requestSaveDraft(){
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'sub_type' => 'required',
            'due_date' => 'required',
            'limit_date' => 'required',
            'priority' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);
        $request = Request::create([
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'sub_type' => $this->sub_type,
            'due_date' => $this->due_date,
            'limit_date' => $this->limit_date,
            'priority' => $this->priority,
            'level' => $this->level,
            'status' => $this->status,
            'requster_id' => auth()->user()->id,
            'group_id' => session('group-id'),
            'is_draft' =>true,
            'color'=> '#ff45b5'
        ]);

        $this->request_id = $request->id;
        $this->is_draft = true;
        $request->url = 'edit-request/'.$request->id;
        $request->save();
        session(['request_id'=>$request->id]);
        session()->flash('message', 'Request data saved as draft ');
    }

    public function itemsSaveDraft(){
        if(!is_null($this->name || $this->value)){
            foreach ($this->name as $key => $value) {
                $items = Item::create([
                    'name' => $this->name[$key],
                    'value' => $this->value[$key],
                    'details' => $this->details[$key],
                    'reference_link' => $this->reference_link[$key],
                    'responsible_dept' => $this->responsible_dept[$key],
                    'payment_method' => $this->payment_method[$key],
                    'request_id' => session('request_id')
                ]);
            }

            $request = Request::find(session('request_id'));
            $request->total_value = $this->value_sum;

            $request->save();

        }
        session()->flash('message', 'Items data saved as draft ');

    }

    public function finacialSaveDraft(){

        $name = $this->invoice->store('invoices');

        Finance::create([
            'bank_id' => $this->bank_id,
            'agency' => $this->agency,
            'account' => $this->account,
            'account_owner' => $this->account_owner,
            'cpf_cnpj' => $this->cpf_cnpj,
            'app_type' => $this->app_type,
            'transaction_url' => $this->transaction_url,
            'invoice_file' => $this->invoice,
            'filename' => $name,
            'request_id' => session('request_id')
        ]);

        session()->flash('message', 'Finance data saved as draft ');
    }

    public function chat(){
        Chat::create([
            'sender_id' => auth()->user()->id,
            'date' => date("Y-m-d"),
            'time' => date("h:i:sa"),
            'message' => $this->message,
            'is_liked' => $this->is_liked,
            'request_id'  =>session('request_id')
        ]);
        $this->message = '';
        $chats = Chat::with(['user'])->where(['request_id' => session('request_id')])->get()->toArray();

        $this->chats = $chats;
    }


    public function save(){
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'sub_type' => 'required',
            'due_date' => 'required',
            'limit_date' => 'required',
            'priority' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);
        $request = Request::create([
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'sub_type' => $this->sub_type,
            'due_date' => $this->due_date,
            'limit_date' => $this->limit_date,
            'priority' => $this->priority,
            'level' => $this->level,
            'status' => $this->status,
            'is_draft' =>false,
            'color' => '#ffdc47',
            'group_id' => session('group-id'),
            'requster_id' => auth()->user()->id,
        ]);

        $this->request_id = $request->id;
        session(['request_id'=>$request->id]);

        if(!is_null($this->name || $this->value)){
            foreach ($this->name as $key => $value) {
                $items = Item::create([
                    'name' => isset($this->name[$key]) ? $this->name[$key] : null,
                    'value' => isset($this->value[$key]) ? $this->value[$key] : null,
                    'details' => isset($this->details[$key]) ? $this->details[$key] : null,
                    'reference_link' => isset($this->reference_link[$key]) ? $this->reference_link[$key] : null,
                    'responsible_dept' => isset($this->responsible_dept[$key]) ? $this->responsible_dept[$key] : null,
                    'payment_method' => isset($this->payment_method[$key]) ? $this->payment_method[$key] : null ,
                    'request_id' => session('request_id')
                ]);



            }
            if(!is_null($this->invoice)){
                foreach ($this->invoice as $key => $file) {
                    $name = $this->invoice[$key] = $file->store('invoices');
                }
            }

            foreach ($this->name as $key2 => $value) {
                Finance::create([
                    'bank_id' => isset($this->bank_id[$key2]) ? $this->bank_id[$key2] : null,
                    'agency' => isset($this->agency[$key2]) ? $this->agency[$key2] : null,
                    'account' => isset($this->account[$key2]) ? $this->account[$key2] : null,
                    'account_owner' => isset($this->account_owner[$key2]) ? $this->account_owner[$key2] : null,
                    'cpf_cnpj' => isset($this->cpf_cnpj[$key2]) ? $this->cpf_cnpj[$key2] : null,
                    'app_type' => isset($this->app_type[$key2]) ? $this->app_type[$key2] : null,
                    'transaction_url' => isset($this->transaction_url[$key2]) ? $this->transaction_url[$key2] : null,
                    'invoice_file' => isset($this->invoice[$key2]) ? $this->invoice[$key2] : null,
                    'payment_type' => isset($this->payment_method[$key2]) ? $this->payment_method[$key2] : null,
                    'request_id' => session('request_id')
                ]);
            }


            $request = Request::find(session('request_id'));
            $request->total_value = $this->value_sum;
            $request->url =  'edit-request/'.$request->id;
            $request->save();

        }

        session()->flash('message', 'All data saved successfully.');
        $this->clear();
    }

    public function clear(){
        $this->title ='';
        $this->description ='';
        $this->type = NULL;
        $this->sub_type ='';
        $this->due_date ='';
        $this->limit_date ='';
        $this->priority ='';
        $this->level ='';
        $this->status ='';
        $this->name ='';
        $this->value ='';
        $this->details ='';
        $this->reference_link ='';
        $this->responsible_dept ='';
        $this->payment_method ='';
        $this->value_sum =0;
        $this->bank_id ='';
        $this->agency ='';
        $this->account ='';
        $this->account_owner ='';
        $this->cpf_cnpj ='';
        $this->app_type ='';
        $this->transaction_url ='';
        $this->invoice ='';
        $this->filename ='';
        $this->inputs = [];
    }

    public function finish(){
        return redirect()->to('/apps/approvals/create-request');
    }

    public function render()
    {
        $typesColl = DB::table('request_types')->get();
        return view('livewire.apps.approvals.create-request')->with(['typesColl' => $typesColl]);
    }
}
