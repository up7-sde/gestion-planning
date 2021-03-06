function createTable(data){
    
    var main = document.querySelector('.Main');
    var table = document.createElement('table');
    table.style.width = '100%';

    var header = document.createElement('tr');
    Object.keys(data[0]).forEach(key => {
        var th = document.createElement('th');
            th.innerHTML = key;
            header.appendChild(th);
    });
    table.appendChild(header);
    
    for (var i = 0; i < data.length; i++) {
        var tr = document.createElement('tr');
        Object.entries(data[i]).forEach(
            ([key, value]) => {
                if (key == 'color'){
                    value = '<a href="/web/param/' + value + '">'+ value +'<a>';
                }
                var td = document.createElement('td');
                td.innerHTML = value;
                tr.appendChild(td);
            }
        )
        table.appendChild(tr);
    }
    main.appendChild(table);    
}

$(function () {
  $('[data-toggle="popover"]').tooltip()
})