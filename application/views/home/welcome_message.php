<div id="container">
	<h1>REST API Documentation</h1>

	<div id="body">

		<div class="section">
			<h2>Introduction</h2>
			<p>This documentation provides an overview of how to use the REST API services. You can interact with the API using HTTP methods such as GET, POST, PUT, and DELETE.</p>
		</div>

		<div class="section">
			<h2>Authentication</h2>
			<p>The API restricts access based on your IP address. Only authorized IPs can send POST, PUT, and DELETE requests.</p>
			<p><pre><code>Allowed IPs: 127.0.0.1, 192.168.1.7, 110.138.91.114</code></pre></p>
		</div>

		<div class="section">
			<h2>Available Endpoints</h2>
			<table class="table-dark" style="border-color: white !important;" border="1" cellpadding="10">
				<thead>
					<tr>
						<th>Endpoint</th>
						<th>Method</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre><code>/api?type=get&db_name=your_db&tb_name=your_table</code></pre>
						</td>
						<td>GET</td>
						<td>Retrieve data from a specific table.</td>
					</tr>
					<tr>
						<td>
							<pre><code>/api?type=insert</code></pre>
						</td>
						<td>POST</td>
						<td>Insert data into a specific table.</td>
					</tr>
					<tr>
						<td>
							<pre><code>/api?type=update</code></pre>
						</td>
						<td>POST</td>
						<td>Update data in a specific table.</td>
					</tr>
					<tr>
						<td>
							<pre><code>/api?type=delete</code></pre>
						</td>
						<td>POST</td>
						<td>Delete data from a specific table.</td>
					</tr>
					<tr>
						<td>
							<pre><code>/api?type=list_db</code></pre>
						</td>
						<td>GET</td>
						<td>List all available databases.</td>
					</tr>
					<tr>
						<td>
							<pre><code>/api?type=list_tb&db_name=your_db</code></pre>
						</td>
						<td>GET</td>
						<td>List all tables in a specific database.</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<style>
	.table-dark td,
	.table-dark th,
	.table-dark thead th {
		border-color: #d0d0d0;
	}

	.hljs-copy-button {
		top: 16px;
	}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>

<script src="https://unpkg.com/highlightjs-copy/dist/highlightjs-copy.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/highlightjs-copy/dist/highlightjs-copy.min.css" />
<script>
	var hjs = hljs.highlightAll();
	// var listLang = hljs.listLanguages();
	// console.log("hljs: ", hljs);
	// console.log("listLang: ", listLang);
	hljs.addPlugin(new CopyButtonPlugin({
		autohide: true, // false = Always show the copy button
	}));

	// document.addEventListener('DOMContentLoaded', (event) => {
	// 	document.querySelectorAll('pre code').forEach((el) => {
	// 		hljs.highlightElement(el);
	// 		console.log("highlightedCode: ", el);
	// 	});
	// });
</script>