function Countdown()
{
    var moksha = 10;
    var today = new Date();
    var dd = today.getDate();
    var mnth = today.getMonth();
    if(mnth==1)
        dd = 29-dd+10;
    else if(mnth==2)
        dd = 10-dd;
    var hr = (24-today.getHours())%24;
    var min = (60-today.getMinutes())%60;
    var sec = (60-today.getSeconds())%60;
    this.start_time = ""+dd+":"+hr+":"+min+":"+sec+"";
    this.name = "seconds";
}

Countdown.prototype.init = function()
{
    this.reset();
    setInterval(this.name + '.tick()', 1000);
}

Countdown.prototype.reset = function()
{
    time = this.start_time.split(":");
    this.days = parseInt(time[0]);
    this.hours = parseInt(time[1]);
    this.minutes = parseInt(time[2]);
    this.seconds = parseInt(time[3]);
    this.update_target();
}

Countdown.prototype.tick = function()
{
    if(this.seconds==0){
        if(this.minutes>0){
            this.seconds = 59;
            this.minutes = this.minutes - 1;
        }
        else if(this.minutes==0){
            if(this.hours>0){
                this.minutes = 59;
                this.hours = this.hours-1;
                this.seconds = 59;
            }
            else if(this.hours==0){
                if(this.days>0){
                    this.hours = 23;
                    this.days = this.days-1;
                    this.minutes = 59;
                    this.seconds = 59;
                }
            }
        }
    }
    else
        this.seconds = this.seconds - 1;
    this.update_target();
}

Countdown.prototype.update_target = function()
{
    seconds = this.seconds;
    minutes = this.minutes;
    hours = this.hours;
    days = this.days;
    if(seconds<10)
        seconds = "0"+seconds;
    if(minutes<10)
        minutes = "0"+minutes;
    if(hours<10)
        hours = "0"+hours;
    document.getElementById('dayss').innerHTML = '<h1>'+days+'</h1><p><b>Days</b></p>';
    document.getElementById('hourss').innerHTML = '<h1>'+hours+'</h1><p><b>Hours</b></p>';
    document.getElementById('minutess').innerHTML = '<h1>'+minutes+'</h1><p><b>Minutes</b></p>';
    document.getElementById('secondss').innerHTML = '<h1>'+seconds+'</h1><p><b>Seconds</b></p>';
}



