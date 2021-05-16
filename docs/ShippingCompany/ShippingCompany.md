# WP-VarejoEcom PLUGIN - Shipping Company #
    Esta documentação refere-se a funcionalidade de controle de transportadoras.

## Problematização ##
Até a disponibilização desta funcionalidade não existia um controle de transportadoras, ou seja, a cada nova transportadora que o e-commerce iria trabalhar era preciso adicionar o **ID** e **CNPJ** em uma classe (Shipping) do código fonte.
Para a semana do **black-friday** foi preciso elaborar uma **contingência no cálculo de frete** caso a **intelipost** ficasse indisponível. Para essa necessidade foi instalado o plugin **WC Tabela de Frete Offline**, porém o plugin atendia em partes a necessidade, no campo **_shipping_method** era adicionado o nome do plugin e este campo é utilizado para adicionar o id de identificação da transportadora na **intelipost** e no **ERP Systêxtil**. E para resolver este problema foi criado a classe **OfflineFreightTable** e com essa classe temos o mesmo problema da classe **Shipping**, precisamos chumbar as informações nela também. 
Com o lançamento do e-commerce **B2B** esse problema piorou porque o desenvolvimento do **B2B** foi terceirizado e as informações das transportadoras foram chumbadas no código também, porém em um plugin (integracao-erp).

##### As classes mencionadas você encontre em: #####
* wp-content/themes/wpbrasil-odin/inc/erp/classes/Shipping.class.php
* wp-content/themes/wpbrasil-odin/inc/erp/controllers/OfflineFreightTable.controller.

## Ativação do plugin ##
Na ativação do plugin é instanciada a classe principal (wp_varejoecom) é chamada a função **wp_varejoecom_create_settings_shipping_company()**, esta função é responsável e verificar se a tabela **wp_vc_shipping_company** existe, do contrário a tabela é criada.

## Descrição ##
A funcionalidade Shipping company tem como responsabilidade cadastrar as transportadoras que o e-commerce irá trabalhar, mostrando quais estão ativas e desativadas. Está funcionalidade conta com duas telas:
* Cadastrar transportadora
* Listar transportadoras

Para manter um histórico não foi desenvolvido a funcionalidade de excluir uma transportadora, só é possível cadastrar e alterar.

## Utilização ##

Na classe **Shipping** a função **getCompany()** foi alterada para consumir a tabela do banco de dados (wp_vc_shipping_company).

De acordo com o id da transportadora que a intelipost retorna, a função retorna o CNPJ correspondente para o id.

Esta classe é consumida no momento da integração do pedido. Arquivo:
* wp-content/themes/wpbrasil-odin/inc/erp/controllers/Order.controller.php

###### Frete Offline ######

Como mencionado anteriormente, existe a funcionalidade de **frete offline** que fica na classe **OfflineFreightTable**. Foi preciso alterar a função **custom_rate_method_id()**  para consumir a base de dados também. Neste caso é recuperado o nome da transportadora adicionada na planilha que o plugin consome e consultado na base dados se existe alguma transportadora com este nome, se sim, é preenchido um array com as informações da transportadora. 
Esse array é utilizado em outro momento, quando o **hook**  **woocommerce_checkout_order_processed** é disparado, em seguida a função **proccessShippingData()** é chamada e essa função recebe por parâmetro o id do pedido, nesta função consumimos o array com os dados da transportadora para gravar as informações no banco de dados, amarrando as informações da transportadora ao pedido.
