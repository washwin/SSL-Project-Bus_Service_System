data=["mumbai","pune","punjab","mumgatti"];

function searchPlaces(loc,str){
    if(str.length > 1){
        // console.log(str);
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "/SSL-Project/routes/function.php?get_place_suggestions="+str, false );
        xmlHttp.send( null );
        result = xmlHttp.responseText.trim();
        data=result.split(',');
        data=data.filter(s=>s.length>0);
        if(data.length==0)return;
        if(data[0].toLowerCase()==str.toLowerCase()){
            document.getElementById(loc+'-suggestions').innerHTML='';
            return;
        }
        var html = '<div class="search-suggestions">';
        for(i in data){
            html += '<div class="suggestionText" onclick="setData(\''+loc+'\',\''+data[i]+'\')">'+data[i]+'</div>';
        }
        html+='</div>';

        document.getElementById(loc+'-suggestions').innerHTML=html;
    }
    else{
        document.getElementById(loc+'-suggestions').innerHTML='';
    }
}

function setData(loc, str){
    // console.log(loc,str);
    document.getElementById('input-'+loc).value=str;
    document.getElementById(loc+'-suggestions').innerHTML='';
}

function swapToAndFrom(event){
    event.preventDefault();
    from = document.getElementById('input-from').value;
    to = document.getElementById('input-to').value;
    // console.log(from,to);
    document.getElementById('input-from').value=to;
    document.getElementById('input-to').value=from;
}
