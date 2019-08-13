<?php
namespace App\Helper;
class DateFunctions{

public function last_day_last_month {
    use Date::Calc qw(Days_in_Month Today);
    
        my ($year, $month, $day) = Today([time]);
    
        if (--$month == 0)
        {
            $month = 12;
            --$year;
        }
    
        return sprintf("%d-%02d-%d", $year,$month,
                                     Days_in_Month($year, $month)
                                     );
    }
}
public function restrict_num_decimal_digits() #used for forcing decimals to two decimal points
{
    my $num=shift;#the number to work on
    #print STDERR "\n Grand Total is $num";
    my $digs_to_cut=3;# the number of digits after 
            # the decimal point to cut 
            #(eg: $digs_to_cut=3 will leave 
            # two digits after the decimal point)
            
    if ($num=~/\d+\.(\d){$digs_to_cut,}/)
      {
        # there are $digs_to_cut or 
        # more digits after the decimal point
        #$num=sprintf("%.".($digs_to_cut-1)."f", $num);
        $num=sprintf "%.2f", $num;
      }
    #print STDERR "\n $num";
    return $num;
}

public function getMonths() #gives a date - an incremental month number
{
    my $incrementer = shift;
    my $month_counter;
    my $pres_date = &getDateStamp();
    my @newdate0 = split("-",$pres_date); #yyyy-mm-dd
    my $year = @newdate0[0];
    my $month = @newdate0[1];
    #now adjust month for incrementer
    my $selectmonth = $month; #set to equal current month to start
    my $selectyear;
    if ($month <=$incrementer)
    {
        $selectmonth = sprintf("%02d", ($month+12 - $incrementer));
        $selectyear = $year--;

    }
    else
    {
        $selectmonth = sprintf("%02d", ($month - $incrementer));
        $selectyear = $year;
    }

     
    my $day = "01";
    $month_counter = "$year" . "-" . "$selectmonth" . "-" . "$day";
    return $month_counter;
}

public function getDateStamp()
{
    my $dt   = DateTime->now;   # Stores current date and time as datetime object
    my $date = $dt->ymd;   # Retrieves date as a string in 'yyyy-mm-dd' format
    return $date;
}