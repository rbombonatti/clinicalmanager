<?php

namespace App\Console\Commands;

use App\Mail\UnpaidConsultationMail;
use App\Models\Consultation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendUnpaidConsultationEmailCommand extends Command
{
    protected $signature = 'email:unpaid-consultations';
    protected $description = 'Enviar email com a listagem de consultas não pagas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $unpaidConsultations = Consultation::whereNull('payment_date')->get();
        if ($unpaidConsultations->isEmpty()) {
            $this->info('Nenhuma consulta não paga encontrada.');
            return;
        }
        Mail::to(env('ADMIN_EMAIL'))->send(new UnpaidConsultationMail($unpaidConsultations));
        $msg = 'Email enviado com sucesso em ' . date('H:i:s d/m/Y ');
        Log::info($msg);
        $this->info($msg);

    }
}
