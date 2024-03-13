<?php

namespace App;

enum PodcastStatus: int
{
    case Unpublished = 1;
    case Publishing = 2;
    case Published = 3;
}
