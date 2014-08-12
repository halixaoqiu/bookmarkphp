<?php
	/**
	 * 访客页面
	 */
	require_once 'config.inc.php';
	require_once '/biz/tag.func.php';
	
	//常量定义
	$page_title = "草莓收藏-方便的管理、分享你的收藏";
	
	$stmt = $pdo->prepare("select * from bookmark where is_public=1 order by create_time desc limit 10");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<div class ="gust-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<h1 class="heading">喝一杯美味的咖啡，学一学Java</h1>
					</div>
					<div class="col-md-5">
						<form accept-charset="UTF-8" action="/join" autocomplete="off" class="form-signup-home js-form-signup-home" method="post"><div style="margin:0;padding:0;display:inline"><input name="authenticity_token" type="hidden" value="Omr4C92IxdfD91dAzN+YAKM/A8SS/bSEuLWtt09DKW7ZvT+GdJ2/7yq6c+QJpkwWKFiF25XJuyUjIq8+eYumBA=="></div>        <dl class="form">
						          <dd>
						            <input type="text" name="user[login]" class="textfield" placeholder="Pick a username" data-autocheck-url="/signup_check/username" autofocus="">
						          </dd>
						        </dl>
						        <dl class="form">
						          <dd>
						            <input type="text" name="user[email]" class="textfield js-email-notice-trigger" placeholder="Your email" data-autocheck-url="/signup_check/email">
						          </dd>
						        </dl>
						        <dl class="form successed">
						          <dd>
						            <input type="password" name="user[password]" class="textfield is-autocheck-successful" placeholder="Create a password" data-autocheck-url="/signup_check/password">
						          </dd>
						          <p class="text-muted">Use at least one lowercase letter, one numeral, and seven characters.</p>
						        </dl>
						        <input type="hidden" name="source_label" value="Homepage Form">
						        <button class="button primary button-block" type="submit">Sign up for GitHub</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>