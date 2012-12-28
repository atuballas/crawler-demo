<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flights Search Panel Demo</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="js/external/calendar/css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="s-form">
	<div class="div-triptype">
    	Round Trip<input type="radio" name="triptype" value="roundtrip" checked="checked"/>
    </div>
    <div class="div-triptype">
    	One Way<input type="radio" name="triptype" value="oneway" />
    </div>
    <div class="cb"></div>
    <div class="div-location">
    	<div class="div-location-inputs" id="from-location">
        	<input type="text" name="input-from-location" id="input-from-location" />
        </div>
        <div class="div-location-inputs" id="to-location">
        	<input type="text" name="input-to-location" id="input-to-location" />
        </div>
        <div class="cb"></div>
    </div>
    <div class="div-location-label">
    	<div class="div-location-inputs" id="from-location-label">
        	From: airport code
        </div>
        <div class="div-location-inputs" id="to-location-label">
        	To: airport code
        </div>
        <div class="cb"></div>
    </div>
    <div class="div-date-label">
    	<div class="div-location-inputs div-date-labels" id="from-date-label">
        	Departure Date
        </div>
        <div class="div-location-inputs div-date-labels" id="to-date-label">
        	Arrival Date
        </div>
        <div class="cb"></div>
    </div>
    <div class="div-location div-date">
    	<div class="div-date-inputs" id="from-date">
        	<input type="text" name="input-date" id="input-date-departure" onclick="showCalendar('input-date-departure')"/>
            <select name="select-time-departure">
            	<option value="anytime">Anytime</option>
            </select>
        </div>
        <div class="div-date-inputs" id="from-date">
        	<input type="text" name="input-date" id="input-date-arrival" readonly="readonly" onclick="showCalendar('input-date-arrival')"/>
            <select name="select-time-arrival" id="select-time-arrival">
            	<option value="anytime">Anytime</option>
            </select>
        </div>
        <div class="cb"></div>
    </div>
    <div class="div-date-label">
    	<div class="div-location-inputs div-date-labels" id="from-adult-label">
        	Adults
        </div>
        <div class="div-location-inputs div-date-labels" id="from-children-label">
        	Children
        </div>
        <div class="cb"></div>
    </div>
    <div class="div-location div-date">
    	<div class="div-adults-inputs" id="noadults">
            <select name="select-adult">
            	<option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
        <div class="div-adults-inputs" id="nochildren">
            <select name="select-adult">
            	<option value="1">0</option>
            </select>
        </div>
        <div class="div-adults-inputs" id="settype">
            <select name="select-settype" id="select-settype">
            	<option value="economy">Economy</option>
                <option value="business">Business</option>
                <option value="first">First</option>
            </select>
        </div>
        <div class="div-adults-inputs" id="submit-button">
            <input type="submit" name="input-submit" id="input-submit" value="Search"/>
        </div>
        <div class="cb"></div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/external/calendar/js/glDatePicker.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
