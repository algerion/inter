<!--DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"-->
<!--html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"-->
<html>
	<com:THead>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="images/logoizq.jpg" type="image/x-icon" />
	</com:THead>
	<body <com:TLiteral ID="litBody" />>
		<com:TForm>
			<com:TClientScript PradoScripts="prado" />
			<com:TClientScript ID="jsLoginfb" ScriptUrl="js/loginfb.js" />
			<com:TClientScript ID="jsDateValid" ScriptUrl="../compartidos/js/datevalid.js" />
			<com:TContentPlaceHolder ID="Cabeceras" />
			<div id="page" align="center">
				<div id="header">
					<com:TTable Width="800" Style="text-align:center" BorderWidth="0" CellPadding="0" CellSpacing="0" BackColor="#CCDDDD">
						<com:TTableRow>
							<com:TTableCell>
								<com:TPanel ID="pnlEncabezado">
									<!--com:TImage ImageUrl="images/banner.png" /-->
								</com:TPanel>
							</com:TTableCell>
						</com:TTableRow>
					</com:TTable>
				</div>

				<div id="menu">
					<com:TTable Width="800" Style="text-align:center" BorderWidth="0" CellPadding="0" CellSpacing="0" BackColor="#CCDDDD">
						<com:TTableRow>
							<com:TTableCell HorizontalAlign="Center">
								<com:TClientScript>
									var myThemeOfficeBase = '../compartidos/PradoCookMenu/JSCookMenu/ThemeOffice/';
								</com:TClientScript>
								<com:JsCookMenu ID="mnuPrincipal" ThemeName="ThemeOffice"
										JsCookMenuPath="../compartidos/PradoCookMenu/JSCookMenu/JSCookMenu.js"
										StyleSheetThemePath="../compartidos/PradoCookMenu/JSCookMenu/ThemeOffice/theme.css"
										JsThemePath="../compartidos/PradoCookMenu/JSCookMenu/ThemeOffice/theme.js"
										MenuOrientation="hbr" />
								<br />
							</com:TTableCell>
						</com:TTableRow>
					</com:TTable>
				</div>
				<div id="fbot"> 
					<fb:login-button scope="public_profile, email" onlogin="checkLoginState();">
					</fb:login-button>
				</div>
				<div id="main" style="visibility: hidden">
					<com:TTable Width="800" Style="text-align:center" BorderWidth="0" CellPadding="0" CellSpacing="0" BackColor="#CCDDDD">
						<com:TTableRow>
							<com:TTableCell>
								<com:TContentPlaceHolder ID="Main" />
								<com:TPanel ID="pnlCerrar">
									<br /><br />
									<com:TActiveButton ID="btnJSCerrar" Text="Cerrar" Attributes.onclick="javascript:window.close();" />
								</com:TPanel>
							</com:TTableCell>
						</com:TTableRow>
					</com:TTable>
				</div>


				<div id="footer">
					<com:TTable Width="800" Style="text-align:center" BorderWidth="0" CellPadding="0" CellSpacing="0" BackColor="#CCDDDD">
						<com:TTableRow>
							<!--com:TTableCell Style="background-image:url(images/pie.png)" width="800" height="20" /-->
							<div id="status" />
						</com:TTableRow>
					</com:TTable>
				</div>
			</div>
		</com:TForm>
	</body>
</html>