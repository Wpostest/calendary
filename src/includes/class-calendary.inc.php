<?php
    class Calendary{
        private $daysOfWeek = array(
            'Niedziela',
            'Poniedziałek',
            'Wtorek',
            'Środa',
            'Czwartek',
            'Piątek',
            'Sobota'
        );

        private $monthNames = array(
            "Styczeń",
            "Luty",
            "Marzec",
            "Kwiecień",
            "Maj",
            "Czerwiec",
            "Lipiec",
            "Sierpień",
            "Wrzesień",
            "Październik",
            "Listopad",
            "Grudzień"
        );

        private $tasks = array();
        private $monthName;
        private $numberDaysOfMonth;
        private $dayOfWeek;
        private $currentDay;
        private $year;
        private $month;
        
        function __construct($month, $year){
            $firstDayOfMonth = mktime(0,0,0,$month, 1, $year);
            $dateComponents = getdate($firstDayOfMonth);
            $currentDay = date('d');

            $this->numberDaysOfMonth = date('t', $firstDayOfMonth);
            $this->monthName = $this->monthNames[$month - 1];
            $this->dayOfWeek = $dateComponents['wday'];
            $this->currentDay = $currentDay;
            $this->year = $year;
            $this->month = $month;
            $this->getTaksFromDb();
        }

        public function getMonthName(){
            return $this->monthName;
        }

        public function getYear(){
            return $this->year;
        }

        protected function getTaksFromDb(){
            include_once 'dbh.inc.php';
            
            $sql = "SELECT fdDate, fdName, DAY(fdDate) as fdDay, MONTH(fdDate) as fdMonth, WEEKDAY(fdDate) as fdWeekDay, DATE_FORMAT(fdDate, '%d-%m-%Y') as fdDisplayDate FROM `tasks` 
                WHERE MONTH(fdDate) = $this->month AND YEAR(fdDate) = $this->year order by DAY(fdDate)";
            $result = mysqli_query($conn, $sql);
            //var_dump(mysqli_error($conn));
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $this->tasks[$row['fdDay']] = $row;
                }
            }
        } 

        protected function build_task($date, $text, $extra_class){
            $html_string = "<div class='calendary__day $extra_class'>";
            $html_string .= "<h6 class='calendary__day--title'>$date</h6>";
            $html_string .= "<p class='calendary__day--paragraf'>$text</p>";
            $html_string .= "</div>";

            return $html_string;
        }

        public function build_calendar(){
            //echo("ILOSC DNI W MIESIACU: " .$this->numberDaysOfMonth. " PIERWSZY DZIEN TYGODNIA: " .$this->dayOfWeek. " AKTUALNY DZIEŃ ". $this->currentDay. "<br>");

            $startFromWeekDay = $this->dayOfWeek == 0 ? 7 : $this->dayOfWeek;
            /*
             1 - Poniedziałek
             2 - Wtorek
             3 - Środa
             4 - Czwartek 
             5 - Piątek 
             6 - Sobota
             7 - Niedziela
            */

            $html_string = "";

            for($i = 1; $i < $startFromWeekDay; $i++){
                $html_string .= $this->build_task("", "", "blank-day");
            }

            for($i = 1; $i <= $this->numberDaysOfMonth; $i++){
                $date = "$i.$this->month.$this->year";
                $text = "";

                if(!empty($this->tasks[$i])){
                    $text = $this->tasks[$i]["fdName"];
                }

                if($i != $this->currentDay){
                    $html_string .= $this->build_task($date, $text, "");
                }
                else{
                    $html_string .= $this->build_task($date, $text, "current-day");
                }

            }

            for($i = 1; $i <= 31 - $this->numberDaysOfMonth; $i++){
                $html_string .= $this->build_task("", "", "blank-day");
            }

            echo($html_string);
        }
    }