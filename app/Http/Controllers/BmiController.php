<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;


class BmiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.bmi');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $a = new konsul($request->namaOrang, $request->berat, $request->tinggi, $request->lahir, $request->kupon);
        // $a->bmi();
        // $a->obes();
        $data = [
            'namaOrang' => $a->nama(),
            'bmi' => $a->bmi(),
            'obes' => $a->obes(),
            'lahir' => $a->umur(),
            'kupon' => $a->checkKonsul(),
        ];

        return view('pages.admin.bmi', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class hitung
{
    public function __construct($namaOrang, $berat, $tinggi, $lahir, $kupon)
    {
        $this->namaOrang = $namaOrang;
        $this->berat = $berat;
        $this->tinggi = $tinggi / 100;
        $this->lahir = $lahir;
        $this->kupon = $kupon;
    }
    public function nama()
    {
        return $this->namaOrang;
    }

    public function bmi()
    {

        return $this->berat / ($this->tinggi * $this->tinggi);
    }
    public function umur()
    {
        $hasil = 2022 - $this->lahir;
        // $birthDate = new \DateTime($this->lahir);
        // $today = new \DateTime("today");
        // if ($birthDate > $today) {
        //     return "0 tahun 0 bulan 0 hari";
        // }
        // $y = $today->diff($birthDate)->y;
        // // dd($y);
        // $m = $today->diff($birthDate)->m;
        // $d = $today->diff($birthDate)->d;
        return $this->lahir =  $hasil;
    }
}

class konsul extends hitung
{
    public function obes()
    {
        $dbmi = $this->bmi();

        if ($dbmi < 18.6) {
            return 'kurus';
        } elseif ($dbmi < 23) {
            return 'Normal';
        } elseif ($dbmi < 30) {
            return 'Gemuk';
        } elseif ($dbmi >= 30) {
            return 'obesitas';
        } else {
            return 'tidak terdaftar';
        }
    }
    public function checkKonsul()
    {
        $umur = $this->umur();
        // $umur2 = (int)$umur;
        $dbmi = $this->bmi();

        if ($umur >= 17 && $umur <= 30 && $dbmi > 29.9) {
            return $this->kupon =  "Gratis Konsultasi";
        } else if ($umur > 30 && $dbmi > 29.9) {
            return $this->kupon =  "Obat Gratis";
        } else {
            return $this->kupon =   `Tidak Memenuhi Syarat`;
        }
    }
}
