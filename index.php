<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>XPTO Vendas</title>
<link rel="stylesheet" href="css/bootstrap.min.css">


</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a
		class="navbar-brand" href="vendas.jsp"><img src="img/logo-senai.jpg"
		height="25px" /></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"><a class="nav-link"
				href="vendas.jsp">XPTO Vendas</a>
            </li>
        </ul>
	</div>
	</nav>
	<div class="container">
		<?php
			if(isset($_GET['mensagem'])){
				
			
		?>
        <div id="mensagem" style="background-color:pink;border:1px solid red ">
            <?= $_GET['mensagem']?>
            <script>
                setTimeout(function(){
                    $("#mensagem").fadeOut(1000);
                }, 3000);
            </script>
        </div>
        <?php
            }
        ?>
		<h3>Faça sua compra</h3>
		<br>

		<form id="form" method="post" action="router.php?controller=item_venda&modo=inserir">
            <input type="hidden" id="cod_item_venda" name="cod_item_venda">
            <select class="custom-select" id="produto"
				name="produto">
                <option selected value="">Selecione o produto</option>
				<?php

				require_once("class/controller/ProdutoController_class.php");
				$produtoCtrl = new ProdutoController();
				$lista = $produtoCtrl->listar();

				foreach($lista as $prod){
					$json = '{"cod":'.$prod->getCod_produto(). ',
						"valor_uni":' . $prod->getValor_unitario().'}';


					// echo "<option value={'cod':"
					// 	.$prod->getCod_produto().", 'valor_uni':"
					// 	.$prod->getValor_unitario()."}\">"
					// 	.$prod->getNome()."</option>";
				

				?>
				<option value='<?= $json?>'>
					<?= $prod->getNome()?>
				</option>;
				<?php 
					};
				?>
			</select>
            <br><br>
            <input type="number" placeholder="Quatidade" name="qtde" id="qtde"
                class="form-control"><br>
<!--
            <input type="number" placeholder="Valor Unitário" name="valor_uni" id="valor_uni"
				class="form-control"><br>
-->
			<button type="submit" id="salvar" class="btn btn-success">Salvar</button>
			<button type="button" id="salvar" class="btn btn-danger"
				onclick="cancelar()">Cancelar</button>
		</form>
		<br> <br>

		
		<!-- FORM DA TABELA -->

		
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col" width="15%">Produto</th>
						<th scope="col" width="30%">Quatidade</th>
						<th scope="col" width="15%">Valor Total</th>
						<th scope="col" width="20%">Ações</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        require_once("class/controller/ItemVendaController_class.php");
                        $itemVendaController = new ItemVendaController("listar");
                    
                        $lista = $itemVendaController->listar();
//                        var_dump($lista);
                        foreach($lista as $item){
                            
                        
                    ?>
					<tr>
						<td><?= $item->nome ?></td>
						<td><?= $item->getQuantidade();?></td>
						<td>R$ <?= $item->getValor_total();?></td>
						<td>
                            <a class="btn btn-danger" href="router.php?controller=item_venda&modo=excluir&codItem=<?=$item->getCod_item_venda()?>">Excluir</a>

                            <input type="submit" value="Editar"
							class="btn btn-warning" onclick="editar(<?= $item->getCod_item_venda()?>)" />
					</tr>
                    <?php
                        }
                    ?>
				</tbody>
            </table>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		function editar(codItem){
			$.ajax({
				url: "router.php?controller=item_venda&modo=buscar",
				type: "post",
				data:{
					cod: codItem
				},
				beforeSend:function(){
					$("#mensagem").html("Aguarde... buscando");
				}
			})
			.done(function(itemVenda){
                
                //converte o json da requisição
                let json = JSON.parse(itemVenda);
                
                //percorre a lista de option do select
                $("#produto > option").each(function(){
                    //pega o value do option
                    let value = $(this).attr("value").toString();
                    //converte de string para json
                    let obj = JSON.parse(value || '{}');
                    
                    //se cod do option for igual ao codigo da requisição
                    
                    if(obj.cod == json.codProduto){
                        //adiciona o atributo selected no option
                        $(this).attr('selected','selected')
                    }else{
                        $(this).removeAttr('selected');
                    }
                });
                
                console.log(json.quantidade);
                $("#qtde").val(json.quantidade);
                
                $("#form").attr("action","router.php?controller=item_venda&modo=editar")
                
                $("#cod_item_venda").val(json.codItemVenda);
                
//                //passando o conteúdo da resposta para json
//                console.log(itemVenda)
//				let produto_editar = JSON.parse(itemVenda);
//                // pegando o select de produto pelo id
//                let slt_produtos = document.getElementById("produto");
//                // pegando a lista de options do select
//                let produtos = slt_produtos.options;
//                let cont = 0;
//                
//                //percorre a lista de options
//                for(let produto of produtos){
//                    
//                    //passando o value do option para json 
//                    let produto_json = JSON.parse(produto.value || "[]");
//                    
//                    //se o codigo do option for igual
//                    //ao codigo do produto vindo da requisição
//                    
//                    if(produto_json.cod == produto_editar.codProduto){
//                        //seta como selecionado
//                        slt_produtos.options[cont].selected = true;
//                    }
//                    cont++;
//                }
//            
//                //seta a quantidade
//                $("#qtde").val(produto_editar.quantidade);
//                
			});
		}
	</script>
</body>
</html>