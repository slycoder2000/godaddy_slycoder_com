// JavaScript source code


function ProcessResult() {

    var sourceArray = document.getElementById('txtBx_Source').value.split('\n');
    var resultString = "";
    //document.forms['ListMod']['txtBx_Result'].value = "testing";

    //document.getElementById('txtBx_Result').value = document.getElementById('txtBx_Source').value;

    // Loop through the length of the array
    for (let item = 0; item < sourceArray.length; item++) {
        resultString += CheckPrefix();
        resultString += CheckStrDelim();
        resultString += sourceArray[item];
        resultString += CheckStrDelim();
        resultString += CheckSuffix();
        resultString += CheckLineDelim(item == sourceArray.length - 1);
        resultString += CheckSeparateLines();

       
        resultString = CheckReplaceCustom(resultString, item + 1);

    }

    resultString += AppendLineCount(sourceArray.length);

    document.getElementById('txtBx_Result').value = resultString;
}

function CheckSeparateLines() {
    if (document.getElementById("chkBx_SeparateLines").checked == true) {
        return '\n';
    } else {
        return '';
    }
}

function CheckStrDelim() {
    if (document.getElementById("chkBx_StringDelim").checked == true) {
        return document.getElementById("txtBx_StringDelim").value;
    } else {
        return '';
    }
}

function CheckLineDelim(IsLastLine) {

    if (document.getElementById("chkBx_LineDelim").checked == true) {
        if (IsLastLine) {
            if (document.getElementById("chkBx_LineDelimLastLine").checked == false) {
                return '';
            } else {
                return document.getElementById("txtBx_LineDelim").value;
            }
        } else {
            return document.getElementById("txtBx_LineDelim").value;
        }

    } else {
        return '';
    }
}

function CheckPrefix() {
    //if (document.getElementById("txtBx_Prefix").value != "") {
    //    return document.getElementById("txtBx_Prefix").value;
    //} else {
    //    return "";
    //}
    return document.getElementById("txtBx_Prefix").value;
}

function CheckSuffix() {
    //if (document.getElementById("txtBx_Suffix").value != "") {
    //    return document.getElementById("txtBx_Suffix").value;
    //} else {
    //    return "";
    //}
    return document.getElementById("txtBx_Suffix").value;
}

function CheckReplaceCustom(resultString, item) {
     
    if (document.getElementById("chkBx_ReplaceCustomLineNum").checked == true) {
        return resultString.replace(new RegExp(document.getElementById("txtBx_ReplaceCustomLineNum").value,"g"), item);
    } else {
        return resultString;
    }
}

function AppendLineCount(LineCount) {
    if (document.getElementById("chkBx_AppendLineCount").checked == true) {
        return LineCount;
    } else {
        return "";
    }
}