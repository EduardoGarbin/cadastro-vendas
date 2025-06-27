<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumoVendasAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public float $valorTotal
    ) {}

    public function build()
    {
        return $this->subject('Resumo Diário de Vendas - Administrador')
            ->markdown('emails.resumo-admin')
            ->with([
                'valorTotal' => $this->valorTotal
            ]);
    }
}
