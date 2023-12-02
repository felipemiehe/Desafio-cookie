<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoasController extends Controller
{
    public function index()
    {
        // $pessoas = Pessoa::all();
        // return $pessoas;
        $data = Pessoa::orderBy('created_at', 'DESC')->get();
        return $data;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Exception | Pessoa
     */
    public function criar(Request $request): Exception|Pessoa
    {
        try{

            $newPessoa = new Pessoa;

            $newPessoa->nome = $request->pessoa['nome'];
            $newPessoa->cpf = $request->pessoa['cpf'];
            $newPessoa->rg = $request->pessoa['rg'];
            $newPessoa->data_nasc = $request->pessoa['data_nasc'];
            $newPessoa->sexo = $request->pessoa['sexo'];
            $newPessoa->save();

            return $newPessoa;
        }


        catch(Exception $e){
            return($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function achaum($id)
    {
        $tempessoa = Pessoa::find( $id );

        if($tempessoa){
            return $tempessoa;
        }else{
            return "Nao foi encrotado pessoas com esse id";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string | Pessoa
     */
    public function update(Request $request, $id)
    {
        $minhaPessoa = Pessoa::find( $id );
        $temPessoa = clone $minhaPessoa;

        if( $temPessoa){
            try
            {
                if( isset($request->pessoa['nome'])){
                    $temPessoa->nome = $request->pessoa['nome'];
                }
                if( isset($request->pessoa['cpf'])){
                    $temPessoa->cpf = $request->pessoa['cpf'];
                }
                if( isset($request->pessoa['rg'])){
                    $temPessoa->rg = $request->pessoa['rg'];
                }
                if( isset($request->pessoa['data_nasc'])){
                    $temPessoa->data_nasc = $request->pessoa['data_nasc'];
                }
                if( isset($request->pessoa['sexo'])){
                    $temPessoa->sexo = $request->pessoa['sexo'];
                }

                $temPessoa->updated_at = date("Y-m-d H:i:s");

                $temPessoa->save();
                return $temPessoa;
            }
            catch(Exception $e)
            {
                return($e);
            }
        } else{
            return "Nao existe essa pessoa";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempessoa = Pessoa::find( $id );

        if($tempessoa){
            $tempessoa->delete();
            return "Deletado com Sucesso";
        } else{
            return "Não existe essa pessoa";
        }

    }
}
