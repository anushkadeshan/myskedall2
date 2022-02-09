<?php

namespace App\Http\Livewire\Apps\Approvals;

use Livewire\Component;
use App\Models\Approvals\Chat;
use App\Models\Approvals\Item;
use App\Models\Approvals\Level;
use App\Models\Approvals\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Approvals\Request as ApprovalsRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditRequest extends Component
{
    use LivewireAlert;

    public $i = 1;
    public $inputs = [];
    public $step1 = false;
    public $step2 = false;
    public $step3 = false;

    public $is_draft = false;
    public $approver = false;

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
    public $requester;
    public $approvers;

    //items
    public $name;
    public $value;
    public $details;
    public $reference_link;
    public $responsible_dept;
    public $payment_method;
    public $value_sum =0;
    public $approved_value;
    public $approver_oberservation;
    public $current_status;

    //finance
    public $bank_id;
    public $agency;
    public $account;
    public $account_owner;
    public $cpf_cnpj;
    public $app_type;
    public $transaction_url;
    public $invoice;
    public $filename;

    public $types;
    public $subtypes = [];

    public $request_id;

    public $sender_id;
    public $message;
    public $is_liked;

    public $chats = [];
    public $levels;

    public $approved_items = [];
    public $changed_items = [];
    public $repproved_items = [];

    public $sum_approved_value;
    public $sum_requested_value;

    //add new item

    //items
    public $new_name;
    public $new_value;
    public $new_details;
    public $new_reference_link;
    public $new_responsible_dept;
    public $new_payment_method;

    public $acknowledgement;

    public function dehydrate(){
        if(empty(!$this->approved_value)){
            $this->sum_approved_value = array_sum($this->approved_value);
        }
    }
    public function mount($id){
        $request = ApprovalsRequest::with('chats','finance','items','requester','levels.approvers','subtype','requestType','items.payments')->find($id);
        
        $approvers = $request->levels->approvers->pluck('id')->toArray();
        if(in_array(auth()->user()->id,$approvers)){
            $req_single = ApprovalsRequest::find($id);
            $req_single->sean_by_user = true;
            $req_single->save();
        }
        $this->title = $request->title;
        $this->request_id = $request->id;
        $this->description = $request->description;
        $this->type = $request->requestType->type;
        $this->sub_type = $request->subtype->sub_type;
        $this->due_date = $request->due_date;
        $this->limit_date = $request->limit_date;
        $this->priority = $request->priority;
        $this->level = $request->level;
        $this->status = $request->status;
        $this->inputs = $request->items;
        $this->acknowledgement = $request->acknowledgement;
        $this->requester = $request->requester->name;
        $this->approvers = $request->levels->approvers;
        $this->current_status = $request->current_status;
        $this->approved_items =$request->items->where('status','Approved');
        $this->changed_items =$request->items->where('status','Changed');
        $this->repproved_items =$request->items->where('status','Repproved');
       // $this->sum_approved_value = $request->items->sum('approved_value');
        $this->sum_requested_value = $request->items->sum('value');


        $this->levels = Level::select('id','name')->get();

        if($id){
            $this->chats = Chat::with(['user'])->where(['request_id' => $id])->get()->toArray();
        }
        if(auth()->user()->approver->count() >0){
            $this->approver = true;
        }


    }

    public function approve($id){
        $item = Item::find($id);
        $item->approved_value = $this->approved_value[$id];
        $item->approver_oberservation = $this->approver_oberservation[$id];
        $item->approved_by = auth()->user()->id;
        $item->status = 'Approved';
        $item->approved_at = now();
        $item->save();

        $request = ApprovalsRequest::with('items')->find($this->request_id);
        $this->approved_items =$request->items->where('status','Approved');
        $this->changed_items =$request->items->where('status','Changed');
        $this->repproved_items =$request->items->where('status','Repproved');

        $this->alert('success', trans('msg.Item approved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
        
    }

    public function repprove($id){
        $item = Item::find($id);
        $item->approved_value = $this->approved_value[$id];
        $item->approver_oberservation = $this->approver_oberservation[$id];
        $item->approved_by = auth()->user()->id;
        $item->approved_at = now();
        $item->status = 'Repproved';
        $item->save();

        $request = ApprovalsRequest::with('items')->find($this->request_id);
        $this->approved_items =$request->items->where('status','Approved');
        $this->changed_items =$request->items->where('status','Changed');
        $this->repproved_items =$request->items->where('status','Repproved');
        $this->alert('success', trans('msg.Item Changed successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function change($id){
        $item = Item::find($id);
        $item->approved_value = $this->approved_value[$id];
        $item->approver_oberservation = $this->approver_oberservation[$id];
        $item->approved_by = auth()->user()->id;
        $item->approved_at = now();
        $item->status = 'Changed';
        $item->save();

        $request = ApprovalsRequest::with('items')->find($this->request_id);
        $this->approved_items =$request->items->where('status','Approved');
        $this->changed_items =$request->items->where('status','Changed');
        $this->repproved_items =$request->items->where('status','Repproved');

        $this->alert('success', trans('msg.Item repproved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function chat(){
        Chat::create([
            'sender_id' => auth()->user()->id,
            'date' => date("Y-m-d"),
            'time' => date("h:i:sa"),
            'message' => $this->message,
            'is_liked' => $this->is_liked,
            'request_id'  =>$this->request_id
        ]);
        $this->message = '';
        $chats = Chat::with(['user'])->where(['request_id' => $this->request_id])->get()->toArray();

        $this->chats = $chats;
    }

    public function Consulting(){
        $request = Request::find($this->request_id);
        $request->current_status = 3;
        $request->color = '#007bff';
        $request->save();
        $this->current_status = 3;
        $this->alert('success', trans('msg.Status Saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function Return(){
        $request = Request::find($this->request_id);
        $request->current_status = 4;
        $request->color = '#808080';
        $request->save();
        $this->current_status = 4;
        $this->alert('success', trans('msg.Status Saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }


    public function Repproved(){
        $request = Request::find($this->request_id);
        $request->current_status = 2;
        $request->color = '#ef5350';
        $request->save();
        $this->current_status = 2;
        $this->alert('success', trans('msg.Status Saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function Approved(){
        $request = Request::find($this->request_id);
        $request->current_status = 1;
        $request->color = '#66bb6a';
        $request->approved_by = auth()->user()->id;
        $request->approved_at = now();
        $request->save();

        $this->current_status = 1;
        $this->alert('success', trans('msg.Status Saved successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function AddNewItem(){
        $items = Item::create([
            'name' => $this->new_name,
            'value' => $this->new_value,
            'details' => $this->new_details,
            'reference_link' => $this->new_reference_link,
            'responsible_dept' => $this->new_responsible_dept,
            'payment_method' => $this->new_payment_method,
            'request_id' => $this->request_id
        ]);

        $this->mount($this->request_id);
        $this->dispatchBrowserEvent('postUpdated');
        $this->new_name = '';
        $this->new_value = '';
        $this->new_details = '';
        $this->new_reference_link = '';
        $this->new_responsible_dept = '';
        $this->new_payment_method = '';
        $this->alert('success', trans('msg.New Item Added'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function updatedAcknowledgement($value){
        $request = Request::find($this->request_id);
        $request->acknowledgement = $value;
        $request->save();
        $this->alert('success', trans('msg.Acknowledgement updated successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function AcknowledgeByRequester(){
        $request = Request::find($this->request_id);
        $request->ackowledgeByRequester = true;
        $request->save();
        $this->alert('success', trans('msg.Acknowledgement updated successfully.'), [
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        $typesColl = DB::table('request_types')->get();
        return view('livewire.apps.approvals.edit-request')->with(['typesColl' => $typesColl]);
    }
}
