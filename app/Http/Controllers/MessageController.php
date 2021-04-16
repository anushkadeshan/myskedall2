<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        return view('mensagens.index');
    }

    public function searchUser(Request $request){
        if ($request->ajax()) {
            $output = "";
            $query = $request->get('query');
            if ($query != '') {
                $users = DB::table('user_groups')
                    ->join('users', 'users.id', '=', 'user_groups.user_id')
                    ->select('users.*')
                    ->where('users.name', 'LIKE', '%' . $query . "%")
                    ->where('user_groups.group_id', session('group-id'))
                    ->get();
            } else {
                $users = DB::table('user_groups')
                    ->join('users', 'users.id', '=', 'user_groups.user_id')
                    ->select('users.*')
                    ->where('user_groups.group_id', session('group-id'))
                    ->get();

            }
            //dd($users);
            if ($users){
                foreach ($users as $key => $request) {
                        $output .= '<tr>' .
                            '<td onclick="javascript:beep(); addUserToChat(' . $request->id . ')" style="padding:4px;"><img class="img img-rounded" width="40"
                    src="' . asset('_dados/plataforma/usuarios/' . $request->id . '.jpg') . '"/></td>' .
                        '<td onclick="javascript:beep(); addUserToChat(' . $request->id . ')" >' . $request->name . ' </td>' .
                            '</tr>';
                    
                }
                return Response($output);
            }
        }
    }

    public function GetUsersChat(Request $request){
        if ($request->ajax()) {
            $output = "";
                $users = DB::table('chat')
                ->join('users', 'users.id', '=', 'chat.idDestinatario')
                ->select('users.*')
                ->where('idRemetente', Auth::user()->id)
                ->groupBy('idDestinatario')
                ->get();
            }
            //dd($users);
            if ($users) {
                foreach ($users as $key => $request) {
                    $output .= '<tr>' .
                    '<td width="40" style="padding-bottom:4px;" onclick="javascript:beep(); addUserToChat(' . $request->id . ')" style="padding:4px;">
                        <div style=position: relative;">
                        <img class="img img-rounded" width="40"
                            src="' . asset('_dados/plataforma/usuarios/' . $request->id . '.jpg') . '"/>
                        </div>
                        </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    
    public function AddUserToChat(Request $request){

        $record = DB::table('chat')->where(['idRemetente'=>Auth::user()->id, 'idDestinatario'=> $request->id])->exists();
        $chatWith = DB::table('users')->where('id', $request->id)->first();

        DB::table('chat')->where(['idRemetente'=>Auth::user()->id, 'idDestinatario'=> $request->id])->update(['lido'=>1]);

        $output = "";
        $output .= '<table width="100%">' .
        '<tr>' .
        '<td width="40" style="padding:4px;"><img class="img img-rounded" width="40"
                src="' . asset('_dados/plataforma/usuarios/' . $chatWith->id . '.jpg') . '"/>' .
        '</td>' .
        '<td style="padding:4px;"><font class="hidden-xs">Chatting With </font><a> ' . $chatWith->name . '</a><br><font style="font-size:12px">'. $chatWith->nickname.'</font></td>' .
        '</tr>' .
        '</table>'.
        '<hr style="margin-top:0px">';
        if($record){

            $chats = DB::table('chat')
                ->where(['idRemetente'=>Auth::user()->id, 'idDestinatario'=> $request->id])
                ->groupBy('data')
                ->groupBy('sentby')
                ->get();
            
            //dd($chats);
            
            $output2="";
            foreach ($chats as $chat) {
                $output2 .= '<span>';

            $data = date_create($chat->data);
            $date = date_format($data, 'm/d/Y H:i');
                if($chat->sentby== $chat->idDestinatario){
                    $output2 .= '<div class="pull-left" style="border-radius:5px;background-color:#ffffff;display:table; max-width:80%; word-wrap:break-word; margin-top:5px; padding:7px; padding-right:15px"><span>' . $chat->mensagem . '</span><br>'.
                    '<small class="pull-right text-muted" style="font-size:10px">'. $date; 
                    if($chat->lido==1){
                        $output2 .= '&nbsp<i class="fa fa-check"></i></small>';
                    }
                }
                if($chat->sentby == $chat->idRemetente){
                    $output2 .= '<div class="pull-right" style="border-radius:5px;background-color:#E1F1E1;display:table; max-width:80%; word-wrap:break-word; margin-top:5px; padding:7px; padding-left:15px"><span>' . $chat->mensagem . '</span><br>'.
                    '<small class="pull-right text-muted"  style="font-size:10px">' . $date;
                    if ($chat->lido == 1) {
                        $output2 .= '&nbsp<i class="fa fa-check"></i></small>';
                    }
                }
                $output2 .='<br>'.
                
                '</div>'.
                '<br>' .
                
                '<br>' .
                '<br>';
    
                $output2 .= '</span>';
            }
            
            return response()->json(['exsist'=>1,'output'=>$output, 'output2' => $output2],200);
        }
        else{
            $chats = DB::table('chat')
                ->where(['idRemetente'=>Auth::user()->id, 'idDestinatario'=> $request->id])
                ->groupBy('data')
                ->groupBy('sentby')
                ->get();
            
            //dd($chats);
            
            $output2="";
            foreach ($chats as $chat) {
                $data = date_create($chat->data);
                $date = date_format($data, 'm/d/Y H:i');
                $output2 .= '<span>';
                $date = date('m/d/Y H:i:s', $chat->data);
                if ($chat->sentby == $chat->idRemetente) {
                    $output2 .= '<div class="pull-right" style="border-radius:5px;background-color:#E1F1E1;display:table; max-width:80%; word-wrap:break-word; margin-top:5px; padding:5px;"><span>' . $chat->mensagem . '</span><br>' .
                        '<small class="pull-right text-muted style="font-size:10px">' . $date . '</small>';
                    if ($chat->lido == 1) {
                        $output2 .= '<small class="pull-right"><i class="fa fa-check"></i></small>';
                    }
                }
                if($chat->sentby== $chat->idDestinatario){
                    $output2 .= '<div class="pull-left" style="border-radius:5px;background-color:#ffffff;display:table; max-width:80%; word-wrap:break-word; margin-top:5px; padding:5px;"><span>' . $chat->mensagem . '</span><br>'.
                    '<small class="pull-right text-muted" style="font-size:10px>'. $date. '</small>'; 
                    if($chat->lido==1){
                        $output2 .= '<small class="pull-right"><i class="fa fa-check"></i></small>';
                    }
                }
                
                $output2 .='<br>'.
                
                '</div>'.
                '<br>' .
                
                '<br>' .
                '<br>';
    
                $output2 .= '</span>';
            }
            DB::table('chat')->insert(['idRemetente'=>Auth::user()->id, 'idDestinatario'=> $request->id, 'mensagem'=>'Welcome']);
            return response()->json(['exsist' =>1, 'output' =>$output, 'output2' => $output2], 200);
        }
        
    }

    public function AddMessageToChat(Request $request){
        DB::table('chat')->insert(['idDestinatario'=> $request->chat_user, 'idRemetente'=> $request->sender, 'mensagem'=> $request->message,'sentBy'=> $request->sender]);
        return Response(200);
    }
}
