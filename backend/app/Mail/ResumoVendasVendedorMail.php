<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumoVendasVendedorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $dados) {}

    public function build()
    {
        return $this->subject('Seu Resumo Diário de Vendas')
            ->markdown('emails.resumo-vendedor')
            ->with(['dados' => $this->dados]);
    }
}
