<?php


class Month {

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    private $month;
    private $year;


    /** Month constructor
    * @param int $month le mois compris entre 1 et 12
    * @param int $year L'année
    * @throws Exception
    */

    public function __construct(?int $month = null, ?int $year = null) 
    {

        if ($month === null) {
            $month = intval(date('m'));
        }

        if ($year === null) {
            $year = intval(date('Y'));
        }
        
        $month = $month % 12 ;

        if ($year < 1970 ) 
        {
            
            throw new Exception("L'année est inférieure à 1970");
        }

        $this->month = $month;
        $this->year = $year;

    }

    /**
    * Retourne le mois en toutes lettres (ex: Mars 2018)
    * @return string
    */

    public function toString (): string {
        return $this->months[$this->month-1] .' '. $this->year;
    }

    /**
    * Retourne le premier jour du mois
    * @return Datetime
    */

    public function getStartingDay(): Datetime {
        return new DateTime("{$this->year}-{$this->month} -01");

    }

    /**
    * Retourne le nombre de semaines dans le mois
    * @return int
    */

    public function getWeeks (): int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month - 1 day');
        $weeks = (intval($end->format('W')) - intval($start->format('W')) + 1);

        if ($weeks < 0) {
            $weeks = intval($end->format('W'));
        }

        return $weeks;
    }

    /**
    * Est ce que le jour est dans le mois en cours ?
    * @param DateTime $date
    * @return bool
    */




    public function withinMonth ($date): bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }








}