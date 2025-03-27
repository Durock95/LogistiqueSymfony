<?php

namespace App\Enum;

enum EtatCommande: string {
  case EN_COURS = 'En cours';
  case EN_INSTANCE = 'En instance';
  case EN_PREPA = 'En préparation';
  case EN_ATTENTE_EXPEDITION = "En attente d'expédition";
  case EXPEDIEE = 'Expédiée';
}