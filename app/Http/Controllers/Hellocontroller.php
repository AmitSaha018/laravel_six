<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Hellocontroller extends Controller
{
    public function Contact() {
        return view ('pages.contact');
    }

    public function About() {
        return view ('pages.about');
    }

}
