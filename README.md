# plugin WP-VarejoEcom

Primeiro plugin criado para plataforma **wordpress**. Esse projeto tem como objetivo concentrar todas funcionalidades que venham a ser criadas no e-commerce da empresa.

**OBS:** O nome **VarejoEcom**  é fictício para proteger a empresa que utiliza este plugin.

## Configurações de Stack
- Wordpress [(download)](https://br.wordpress.org/download/)
- PHP >= 7.4

## Funcionalidades
Este plugin cria um menu no painel administrativo do wordpress chamado VarejoEcom.

- Gerenciamento de transportadoras

As transportadoras utilizadas no e-commerce da empresa são cadastradas na intelipost, porém, a intelipost só envia o **ID** da transportadora para e-commerce após realizar o leilão, o problema que o ERP que o e-commerce é integrado recebe obrigatoriamente o CNPJ da transportadora. Para solucionar este problema foi criado uma classe com os CNPJs das transportadoras. Toda vez que a empresa fecha um novo contrato de transportadora temos que alterar esta classe, adicionando em um array o **ID** intelipost e **cnpj**. Com este plugin as transportadoras são cadastradas pelo admin do worpress e a classe só consome as informações do **banco de dados**.