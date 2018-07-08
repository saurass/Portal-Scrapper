function makeTableHTML(myArray) {
    var count=0;
    var result = "<table class='responsive-table striped'>";
    for (var i = 0; i < myArray.length; i++) {
        if(count!==0)
            result += "<tr>";
        else
            result += "<thead><tr class='blue lighten-5'>";
        for (var j = 0; j < myArray[i].length; j++) {
            if(count!==0)
                result += "<td>";
            else
                result += "<th>";
            result += myArray[i][j];
            if(count!==0)
                result += "<td>";
            else
                result += "<th>";
        }
        if(count!==0)
            result += "</tr>";
        else
            result += "</thead></tr>";

        count++;
    }
    result += "</table>";

    return result;
}