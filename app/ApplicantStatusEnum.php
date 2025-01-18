<?php

namespace App;

enum ApplicantStatusEnum: string
{

    case PENDING = 'pending';
    case DITERIMA = 'diterima';
    case DITOLAK = 'ditolak';
}
