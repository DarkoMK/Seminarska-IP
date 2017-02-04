<?php

namespace App\Console\Commands;

use App\Naredbi;
use App\Ured;
use Carbon\Carbon;
use Illuminate\Console\Command;

class IzvrsiNaredbi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IzvrsiNaredbi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gi izvrsuva predefiniranite zadaci vo ramkite na sistemot';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //zemi gi site naredbi sto se <= od segasnoto vreme i vkluci/iskluci gi uredite
        //proveri v-vklucuvanje, ako e minato setiraj null i vkluci
        //proveri v-isklucuvanje, ako e minato setiraj null i iskluci
        //proveri gi i dvete, ako se null izbrisi
        $current_time = Carbon::now();

        $za_vklucuvanje = Naredbi::whereNotNull('vreme_vklucuvanje')->whereNull('vreme_isklucuvanje')->where('vreme_vklucuvanje', '<=', $current_time)->where('na_tajmer', '=', 1)->get();
        foreach ($za_vklucuvanje as $naredba){
            $ured = Ured::find($naredba->id_ured);
            $ured->vklucena_sostojba = 1;
            $ured->save();
            $naredba->na_tajmer = 0;
            $naredba->save();
        }

        $za_isklucuvanje = Naredbi::whereNotNull('vreme_isklucuvanje')->whereNull('vreme_vklucuvanje')->where('vreme_isklucuvanje', '<=', $current_time)->where('na_tajmer', '=', 1)->get();
        foreach ($za_isklucuvanje as $naredba){
            $ured = Ured::find($naredba->id_ured);
            $ured->vklucena_sostojba = 0;
            $ured->save();
            $naredba->na_tajmer = 0;
            $naredba->save();
        }

        $za_vklucuvanje_isklucuvanje = Naredbi::whereNotNull('vreme_vklucuvanje')->whereNotNull('vreme_isklucuvanje')->where('vreme_vklucuvanje', '<=', $current_time)->where('vreme_isklucuvanje', '>', $current_time)->where('na_tajmer', '=', 1)->get();
        foreach ($za_vklucuvanje_isklucuvanje as $naredba){
            $ured = Ured::find($naredba->id_ured);
            $ured->vklucena_sostojba = 1;
            $ured->save();
        }

        $za_isklucuvanje_vklucuvanje = Naredbi::whereNotNull('vreme_vklucuvanje')->whereNotNull('vreme_isklucuvanje')->where('vreme_vklucuvanje', '>', $current_time)->where('vreme_isklucuvanje', '<=', $current_time)->where('na_tajmer', '=', 1)->get();
        foreach ($za_isklucuvanje_vklucuvanje as $naredba){
            $ured = Ured::find($naredba->id_ured);
            $ured->vklucena_sostojba = 0;
            $ured->save();
        }

        $vk_dvete = Naredbi::whereNotNull('vreme_vklucuvanje')->whereNotNull('vreme_isklucuvanje')->where('vreme_vklucuvanje', '<=', $current_time)->where('vreme_isklucuvanje', '<=', $current_time)->where('na_tajmer', '=', 1)->get();
        foreach ($vk_dvete as $naredba){
            $ured = Ured::find($naredba->id_ured);
            $v_k = strtotime($naredba->vreme_vklucuvanje);
            $v_i = strtotime($naredba->vreme_isklucuvanje);
            if ($v_k > $v_i) {
                $ured->vklucena_sostojba = 1;
            }else{
                $ured->vklucena_sostojba = 0;
            }
            $ured->save();
            $naredba->na_tajmer = 0;
            $naredba->save();
        }

        Naredbi::whereNull('vreme_vklucuvanje')->whereNull('vreme_isklucuvanje')->delete();
    }
}
