var from = null,
            start = 0,
            url = "http://25.45.184.240:8888/sistema/modelos/Chat.php"; //TODO: CON HAMACHI
            url = "http://localhost:8888/sistema/modelos/Chat.php";
        $(document).ready(function () {
            from = prompt("Ingresa nombre");
            load();
            $("form").submit(function (e) {
                $.post(url, {
                    message: $("#message").val(),
                    from: from,
                });
                $("#message").val("");
                return false;
            });
        });

        function load() {
            $.get(url + "?start=" + start, function (result) {
                if (result.items) {
                    result.items.forEach((item) => {
                        start = item.id;
                        $("#messages").append(renderMessage(item));
                    });
                    $("#messages").animate({
                        scrollTop: $("#messages")[0].scrollHeight,
                    });
                }
                load();
            });
        }
        //TODO: ORGANIZAR
        function renderMessage(item) {
            let time = new Date(item.created);
            time = `${time.getHours()}:${time.getMinutes()}:${time.getMilliseconds("SS")}`;
            console.log(item.created);
            return `<div class="msg"><p>${item.from}</p>${item.message}<span>${time}</span></div>`;
        }

        