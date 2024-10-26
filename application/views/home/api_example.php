<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #2c3e50;
    }

    .section {
        margin-bottom: 20px;
    }

    pre {
        /* background-color: #f4f4f4; */
        /* padding: 15px; */
        border-radius: 5px;
        overflow: auto;
        margin-bottom: 0px;
    }

    code {
        font-family: Consolas, monospace;
        font-size: 14px;
        max-height: 300px;
    }

    .copy-btn {
        cursor: pointer;
        margin-left: 10px;
        color: #007bff;
        position: relative;
        display: contents;
        justify-content: right;
        top: -15px;
        right: 10px;
    }

    .hljs-copy-button {
        top: 16px;
        right: 15px;
    }

    .hljs-copy-button:hover {
        cursor: pointer;
        background-color: #cdcdcd !important;
        color: #2c3e50 !important;
    }

    .hljs-copy-button {
        position: relative;
        margin: calc(var(--hljs-theme-padding) / 2) !important;
        width: calc(16px + var(--hljs-theme-padding)) !important;
        height: calc(16px + var(--hljs-theme-padding)) !important;
        font-size: .8125rem;
        text-indent: -9999px;
        color: var(--hljs-theme-color);
        border-radius: .25rem;
        border: 1px solid;
        border-color: color-mix(in srgb, var(--hljs-theme-color), transparent 80%);
        background-color: var(--hljs-theme-background);
        transition: background-color 200ms ease;
        overflow: hidden;
    }

    #json_viewer {
        background-color: #282c34;
        color: orange;
    }

    .json-string {
        color: #98c379 !important;
    }

    .json-literal {
        color: #c678d2 !important;
    }
</style>

<div id="container">
    <h1>Example API</h1>
    <div id="body">
        <div class="section row">
            <div class="col-4 mb-3">
                <label for="">Type</label>
                <select name="req_type" id="req_type" class="form-control">
                    <option value="">--- Choose here ---</option>
                    <option value="list_db" selected>List Database</option>
                    <option value="list_tb">List Table Database</option>
                    <option value="get">Get Data</option>
                    <option value="filter">Filter Data</option>
                    <option value="search">Search Data</option>
                    <option value="insert">Insert Data</option>
                    <option value="update">Update Data</option>
                    <option value="delete">Delete Data</option>
                </select>
            </div>
            <div class="col-6 mb-3">
                <label for="">Parameter</label>
                <input type="text" name="req_param" id="req_param" class="form-control" value="db_name=database_name&tb_name=table_name&limit=100&offset=0" placeholder="db_name=database_name&tb_name=table_name&limit=100&offset=0" />
            </div>
            <div class="col-2 mb-3">
                <span>&nbsp;</span>
                <button type="button" id="action" class="btn btn-dark mt-2 w-100">Run API</button>
            </div>
        </div>

        <div class="section">
            <h5>Result Output
                <span class="copy-link">
                    <a id="viewApi" href="#" target="_blank" class="btn btn-dark btn-sm"><i class="fa fa-link"></i> View API</a>
                    <button id="btnCopyApi" type="button" onclick="copyContent()" class="btn btn-sm btn-primary"><i class="far fa-copy"></i> Copy URL API</button>
                </span>
            </h5>
            <div id="parent_time" class="w-100 mb-3" style="display: none;">Request Time: <strong id="request_time"></strong></div>

            <div id="json_viewer"></div>
        </div>
    </div>
</div>

<div id="container">
    <h1>API Example</h1>
    <div id="body">

        <div class="section">
            <h2>GET Request Example</h2>
            <p>Use the following cURL command to retrieve data:
                <a href="<?= base_url() ?>api?type=get&db_name=u8378009_db_kla_req&tb_name=tb_users&limit=5&offset=0" target="_blank" rel="noopener noreferrer">Demo API</a>
            </p>
            <pre><code data-lang="javascript">curl -X GET "<?= base_url() ?>api?type=get&db_name=your_db&tb_name=your_table"</code></pre>
        </div>

        <div class="section">
            <h2>POST Request Example</h2>
            <p>Use the following cURL command to insert data:</p>
            <pre><code data-lang="javascript">curl -X POST -d "field1=value1&field2=value2" "<?= base_url() ?>api?type=insert&db_name=your_db&tb_name=your_table"</code></pre>
        </div>

        <div class="section">
            <h2>PUT Request Example</h2>
            <p>Use the following cURL command to update data:</p>
            <pre><code data-lang="javascript">curl -X PUT -d "field1=new_value1&field2=new_value2" "<?= base_url() ?>api?type=update&db_name=your_db&tb_name=your_table"</code></pre>
        </div>

        <div class="section">
            <h2>DELETE Request Example</h2>
            <p>Use the following cURL command to delete data:</p>
            <pre><code data-lang="javascript">curl -X DELETE -d "id=your_id" "<?= base_url() ?>api?type=delete&db_name=your_db&tb_name=your_table"</code></pre>
        </div>

        <div class="section">
            <h3>Using Fetch API</h3>
            <pre><code data-lang="javascript">fetch("<?= base_url('api/endpoint') ?>", {
    method: "GET",
    headers: {
        "Accept": "application/json"
    }
}).then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));</code></pre>
        </div>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/sql.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/json.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>

<script src="https://unpkg.com/highlightjs-copy/dist/highlightjs-copy.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/highlightjs-copy/dist/highlightjs-copy.min.css" />

<!-- JSON Viewer -->
<link rel="stylesheet" href="<?= base_url() ?>JSONDataViewer\json-viewer\jquery.json-viewer.css">
<script src="<?= base_url() ?>JSONDataViewer\json-viewer\jquery.json-viewer.js"></script>

<!-- Custom Loading -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>custom-loading/css/modal-loading.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>custom-loading/css/modal-loading-animate.css" />
<script src="<?= base_url() ?>custom-loading/js/modal-loading.js"></script>

<script>
    // var hjs = hljs.highlightAll();
    // var listLang = hljs.listLanguages();
    // console.log("hljs: ", hljs);
    // console.log("listLang: ", listLang);
    hljs.addPlugin(new CopyButtonPlugin({
        autohide: false, // false = Always show the copy button
    }));

    document.addEventListener('DOMContentLoaded', (event) => {
        var total = document.querySelectorAll('pre code');
        console.log("total: ", total.length, total);

        document.querySelectorAll('pre code').forEach((el) => {
            // console.log("highlightedCode: ", el);
            removeLanguageClass(el);
            var lang = $(el).data("lang");

            if (lang != undefined) {
                $(el).addClass("language-" + lang);
            }
            hljs.highlightElement(el);

        });
    });

    function removeLanguageClass(element) {
        // Dapatkan semua kelas pada elemen
        var classes = $(element).data("lang");
        $(element).addClass("language-" + classes);

        classes = $(element).attr("class").split(" ");
        // Loop melalui kelas untuk menemukan yang berawalan "language-"
        classes.forEach(function(className) {
            if (className.startsWith("language-")) {
                $(element).removeClass(className);
            }
        });
    }

    function showLoading() {
        var loading = new Loading({
            direction: 'hor',
            discription: 'Loading...',
            defaultApply: true,
        });
        return loading;
    }

    function hideLoading(loading) {
        setTimeout(() => loading.out(), 1000);
    }
</script>

<script>
    const req_type = $("#req_type");
    const req_param = $("#req_param");
    const btn_action = $("#action");
    let result_output = $("#result_output");
    btn_action.on("click", runAPI);

    req_type.on("change", (e) => {
        var val = req_type.val();
        var check = (val == "list_db");

        if (val == "list_db") {
            req_param.attr("disabled", "disabled");
        } else {
            req_param.removeAttr("disabled");
        }
        console.log("change: ", check, val);
    });

    const copyContent = async () => {
        var text = $("#viewApi").attr("href");
        console.log("text: ", text);
        try {
            await navigator.clipboard.writeText(text);
            console.log('Content copied to clipboard');
            showAlertTimer("success", "Success", "Copied to clipboard");
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }

    function runAPI() {
        var type = req_type.val();
        var param = "";
        var isValid = false;
        if (type == "list_db") {
            isValid = true;
        } else {
            if (req_param.val() == "") {
                isValid = false;
                alert("Parameter is required");
            } else {
                param = "&" + req_param.val();
                isValid = true;
            }
        }

        if (isValid) {
            let urlAPI = `<?= base_url() ?>api?type=${type}${param}`;
            var getType = checkType();
            console.clear();
            console.log("getType: ", getType);
            console.log("urlAPI: ", urlAPI);

            // Catat waktu sebelum request dimulai
            const startTime = Date.now();
            const loading = showLoading();

            $("#viewApi").attr("href", urlAPI);
            // $("#btnCopyApi").attr("href", urlAPI);

            fetch(urlAPI, {
                    method: getType,
                    headers: {
                        "Accept": "application/json"
                    }
                }).then(response => response.json())
                .then((data) => {
                    console.log("result: ", data);

                    // Set JSON Viewer : https://www.jqueryscript.net/other/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer.html
                    var options = {
                        collapsed: true, // Default: true.
                        rootCollapsable: false, // Default: true.
                        withQuotes: false, // Default: false.
                        withLinks: false, // Default: false.
                        bigNumbers: false, // Default: false.
                    };
                    var input = eval('(' + JSON.stringify(data, "", 5) + ')');
                    console.log("inputJson: ", input);
                    $("#json_viewer").jsonViewer(input, options);

                    // Mengaktifkan highlight dan tombol salin
                    hljs.addPlugin(new CopyButtonPlugin({
                        autohide: false
                    }));

                    // Catat waktu setelah respons diterima
                    const endTime = Date.now();

                    // Hitung selisih waktu dalam milidetik
                    const requestTimeMs = endTime - startTime;
                    const requestTimeSeconds = (requestTimeMs / 1000).toFixed(2); // dalam detik dengan 2 desimal

                    // Tampilkan waktu request di HTML
                    $("#parent_time").show();
                    document.getElementById('request_time').textContent = `${requestTimeMs} ms (${requestTimeSeconds} s)`;

                    hideLoading(loading);
                })
                .catch((error, er) => {
                    console.error('Error:', error);
                    showAlertTimer('error', "Something went wrong!", `<strong><pre>${error}</pre></strong>`);
                    hideLoading(loading);
                });
        }
    }

    function checkType() {
        var isType = "";
        var type = req_type.val();

        if (type == "list_db" || type == "list_tb" || type == "get" || type == "filter" || type == "search") {
            isType = "GET";
        } else if (type == "insert") {
            isType = "POST";
        } else if (type == "update") {
            isType = "PUT";
        } else if (type == "delete") {
            isType = "DELETE";
        }
        return isType;
    }

    function showAlert() {
        Swal.fire({
            title: "<strong>HTML <u>example</u></strong>",
            icon: "info",
            html: `
                You can use <b>bold text</b>,
                <a href="#" autofocus>links</a>,
                and other HTML tags
            `,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `<i class="fa fa-thumbs-up"></i> Great!`,
            confirmButtonAriaLabel: "Thumbs up, great!",
            cancelButtonText: `<i class="fa fa-thumbs-down"></i>`,
            cancelButtonAriaLabel: "Thumbs down"
        });
    }

    function showAlertTimer(type = "success", judul = "Your work has been saved", pesan = "Something went wrong!", posisi = "center") {
        Swal.fire({
            title: judul,
            // text: pesan,
            html: pesan,
            position: posisi, // top-end, top-start, center
            icon: type,
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 3000, // 3 detik
        });
    }
</script>