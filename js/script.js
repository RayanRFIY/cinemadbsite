var table = null;

function isNumeric(string){
    if(typeof string === "number")
        return true;
    if(typeof string === "string" && string != ""){
      return !isNaN(string);
    }
    return false
  }

var orderAscDesc = 1;
var lastIndex = -1;

function orderBy(index){
    
    index = parseInt(index);
    orderAscDesc = index == lastIndex ? orderAscDesc * -1 : 1;
    
    for (let i = 0; i < table.length; i++) {
        var min = i;
        for (let j = i; j < table.length; j++) {
            let valueA = table[j][index], valueB = table[min][index];
            if(isNumeric(valueA) && isNumeric(valueB)){
                if(parseFloat(valueA) * orderAscDesc < parseFloat(valueB) * orderAscDesc){
                    min = j;
                }
            }
            else{
                if(valueA.localeCompare(valueB) * orderAscDesc < 0){
                    min = j;
                }
            }
        }
        
        let swapped = swap(table[i],table[min]);
        table[i] = swapped[0];
        table[min] = swapped[1];
    }
    

    for (let i = 0; i < table.length; i++) {
        var tr = document.createElement("tr");

        for (let j = 0; j < table[i].length; j++) {
            let td = document.createElement("td");
            td.innerHTML = table[i][j];
            tr.appendChild(td);
        }

        document.getElementById(i).innerHTML = tr.innerHTML;
    }
    lastIndex = index;

}

function createTable(){
    let content = document.getElementById("content-table").children[0];
    var t = [];
    for (let i = 0; i < content.childElementCount-1; i++) {
        var row = content.children[i+1];
        t[i] = [];
        for (let j = 0; j < row.childElementCount; j++) {
            let value = row.children[j].innerHTML;
            t[i][j] = value;
        }
    }

    table =   t;
}

function swap(a,b){
    return [b,a];
}