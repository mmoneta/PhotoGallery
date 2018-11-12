/*var inpsToMonitor = document.querySelectorAll ("form#register-form input");
for (var J = inpsToMonitor.length - 1;  J >= 0;  --J) {
    inpsToMonitor[J].addEventListener ("change",    adjustStyling, false);
    inpsToMonitor[J].addEventListener ("keyup",     adjustStyling, false);
    inpsToMonitor[J].addEventListener ("focus",     adjustStyling, false);
    inpsToMonitor[J].addEventListener ("blur",      adjustStyling, false);
    inpsToMonitor[J].addEventListener ("mousedown", adjustStyling, false);

    //-- Initial update. note that IE support is NOT needed.
    var evt = document.createEvent ("HTMLEvents");
    evt.initEvent ("change", false, true);
    inpsToMonitor[J].dispatchEvent (evt);
}

function adjustStyling (zEvent) {
    var inpVal  = zEvent.target.value;
    if (inpVal  &&  inpVal.replace (/^\s+|\s+$/g, "") )
        zEvent.target.style.border = "1px solid green";
    else
        zEvent.target.style.border = "1px solid white";
    if (document.getElementsByName("password")[0] != document.getElementsByName("repeat-password")[0])
      document.getElementsByName("password")[0].style.border = "1px solid red";
}*/