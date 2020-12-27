<style>
	.categorie-item .nav-link {
		background: #000;
		color: #fff !important;
		border: 0;
	}

	.categorie-item:hover .nav-link:not(.active) {
		background: rgb(100, 100, 100);
	}

	.categorie-item .nav-link.active {
		color: #000 !important;
		border: 1px solid #000;
	}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Mise à jour CraftMyWebsite
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'update', 'showPage')) { ?>

<div class="row">
	<div class="col-md-12 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder à cette page.</strong>
		</div>
	</div>
</div>
<?php } else {?>
<div class="row">

	<div class="col-md-12">
		<?php include("./include/version.php");
		include("./include/version_distant.php");
		if($versioncms == $versioncmsrelease) { ?>
		<div class="alert alert-success">
			<strong>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</strong>
		</div>
		<?php } else { ?>
		<div class="alert alert-danger">
			<strong>Votre CMS CraftMyWebsite n'est PAS à jour ! Vous êtes en <?php echo $versioncms; ?> et la dernière
				version est la <?php echo $versioncmsrelease; ?> ! Attention, les mises à jour ne se font pas
				automatiquement !</strong><strong>Cliquez ici pour télécharger la mise à jour de la dernière version :
				<a href="http://craftmywebsite.fr/release/CraftMyWebsite-<?php echo $versioncmsrelease; ?>MAJ.php"
					class="btn btn-warning">CraftMyWebsite V<?php echo $versioncmsrelease; ?> </a></strong>

		</div>
		<?php } ?>
	</div>

</div>
<?php } ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Contributeurs au CMS
	</h2>
</div>

<div class="col-md-12 col-xl-12 col-12" id="authors">
	<div class="row pb-3" id="contributeurs">
		<div class="col-md-3 col-sm-12">

			<ul class="categorie-content nav nav-tabs pt-4" id="versionList" style="color: black !important;border-bottom: none;">

			</ul>

		</div>
		<div class="col-md-9 col-sm-12">
			<div class="tab-content" id="tabversionList">
				<div id="version-1.8" class="tab-pane fade in active show" aria-expanded="false">
				</div>
			</div>
		</div>

	</div>
</div>

<script>
	let url = "include/contributeurs.json"

	function getUrl(url) {
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("GET", url, false); // false for synchronous request
		xmlHttp.send(null);
		return xmlHttp.responseText;
	}

	function changeTab(e) {
		let src = e.srcElement;
		let ver = src.hash.replace("#ver-", "");

		let tabContainer = document.getElementById("tabversionList");
		let tabContainerChild = tabContainer.children;
		for (let i = 0; i < tabContainerChild.length; i++) {
			let tab = tabContainerChild[i];
			if (tab.id == "version-" + ver) {
				tab.className = tab.className + " in active show";
			} else {
				tab.className = tab.className.replace(" in active show", "");
			}
		}

		let versionList = document.getElementById("versionList");
		let versionListChild = versionList.children;
		for (let i = 0; i < versionListChild.length; i++) {
			let item = versionListChild[i];
			if (item.hash == "#ver-" + ver) {
				item.className = item.className + " active";
				item.parentNode.className = item.parentNode.className + " active";
			} else {
				item.className = item.className.replace(" active", "");
			}
		}
	}

	window.onload = function () {
		let data = getUrl(url);
		if (data) {
			let json = JSON.parse(data);
			if (json) {
				let versions = Object.keys(json);

				let tabContainer = document.getElementById("tabversionList");

				/* --- GESTION TABLEAU SELECTION DE VERSION --- */
				let nb = 0;
				versions.forEach(ver => {
					var itemVersion = document.createElement("li");

					itemVersion.className = "categorie-item nav-item col-md-12";
					if (nb == 0) {
						itemVersion.innerHTML = "<a href='#ver-" + ver +
							"' onclick='changeTab(event)' class='nav-link categorie-link text-center active mb-2' data-toggle='tab'>CraftMyWebsite " +
							ver + "</a>";
					} else {
						itemVersion.innerHTML = "<a href='#ver-" + ver +
							"' onclick='changeTab(event)' class='nav-link categorie-link text-center mb-2' data-toggle='tab'>CraftMyWebsite " +
							ver + "</a>";
					}

					document.getElementById("versionList").appendChild(itemVersion);


					/* --- PANEL POUR CHAQUE VERSION --- */

					let tabVersion = document.createElement("div");
					tabVersion.id = "version-" + ver;
					tabVersion.className = "tab-pane fade";
					if (nb == 0) {
						tabVersion.className = tabVersion.className + " in active show";
						tabVersion.setAttribute("aria-expanded", "true");
					} else {
						tabVersion.setAttribute("aria-expanded", "false");
					}
					tabContainer.appendChild(tabVersion);

					let roles = Object.keys(json[ver]);
					let j = 0;
					roles.forEach(role => {
						//On créé une row pour le role
						let row = document.createElement("div");
						row.className = "row";
						tabVersion.appendChild(row);

						//La première ligne de la row sera le nom du role
						let rowName = document.createElement("div");
						rowName.className = "col-sm-12 text-center";
						row.appendChild(rowName);

						let contributeurs = json[ver][role];
						contributeurs.forEach(nom => {
							let rowContrib = document.createElement("div");
							rowContrib.className = "col-sm-6 col-lg-4";
							rowContrib.innerHTML =
								"<div class='card'><div class='card-header'><h3>" +
								nom +
								"</h3></div><div class='card-body'><img width='50%' style='margin-left:25%' src='https://cravatar.eu/helmavatar/" +
								nom + "/256.png' alt='Photo de profil'></div></div>"
							row.appendChild(rowContrib);
						})


						//On ajoute un séparateur si ce n'est pas le dernier role à afficher
						if (j < roles.length - 1) {
							let hr = document.createElement("hr");
							tabVersion.appendChild(hr);
						}
						j++;
					})


					nb++;
				})



			}
		}
	}
</script>