<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $commandes;
    public $quantite;
    public $prix_total;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $commandes, $quantite, $prix_total)
    {
        $this->user = $user;
        $this->commandes = $commandes;
        $this->quantite = $quantite;
        $this->prix_total = $prix_total;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Générer le PDF
        $pdf = PDF::loadView('commande.facture', [
            'user' => $this->user,
            'commandes' => $this->commandes,
            'quantite' => $this->quantite,
            'prix_total' => $this->prix_total
        ]);

        return $this->from('kantechagency@gmail.com')
                    ->subject('Votre Facture ISI Burger')
                    ->view('mail.emailconfirmation') // Vue email simple
                    ->attachData($pdf->output(), "facture_{$this->user->id}.pdf"); // Ajout du PDF
    }
}
