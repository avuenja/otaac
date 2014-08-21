<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo url; ?>">
				<?php echo nameServer; ?>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li <?php if($this->params['controller'] == 'admin' && $this->params['action'] == 'index') { ?> class="active" <?php } ?>>
					<a href="<?php echo url; ?>admin">Dashboard</a>
				</li>
				<li <?php if($this->params['controller'] == 'posts' || $this->params['controller'] == 'content') { ?> class="active" <?php } ?> class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Content <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li <?php if($this->params['controller'] == 'posts' && $this->params['action'] == 'consult') { ?> class="active" <?php } ?>>
							<a href="<?php echo url; ?>posts/consult">Posts</a>
						</li>
						<li class="divider"></li>
						<li <?php if($this->params['controller'] == 'content' && $this->params['action'] == 'pages') { ?> class="active" <?php } ?>>
							<a href="<?php echo url; ?>content/pages">Pages</a>
						</li>
					</ul>
				</li>
				<li><a href="#">Reports</a></li>
				<li <?php if($this->params['controller'] == 'settings') { ?> class="active" <?php } ?> class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li <?php if($this->params['controller'] == 'admin' && $this->params['action'] == 'server') { ?> class="active" <?php } ?>>
							<a href="<?php echo url; ?>settings/server">Server</a>
						</li>
						<li class="divider"></li>
						<li <?php if($this->params['controller'] == 'admin' && $this->params['action'] == 'translation') { ?> class="active" <?php } ?>>
							<a href="<?php echo url; ?>settings/translation">Translation</a>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $this->Session->read('Account.name'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo url; ?>">Back to site</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo url; ?>accounts/logout">Log out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>