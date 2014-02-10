Nota Fiscal Eletrônica
===
Projeto em PHP que pretende contemplar:

* Criação do arquivo XML;
* Assinatura;
* Validação;
* Envio;
* Tratamento do retorno.

# Manual utilizado:

http://www.nfe.fazenda.gov.br/portal/exibirArquivo.aspx?conteudo=zxlLdxB/oYA=

# Lista de URLs de Homologação:

http://www.nfe.fazenda.gov.br/portal/webServices.aspx?tipoConteudo=Wak0FwB7dKs=

# Pacote de XSD:

http://www.nfe.fazenda.gov.br/portal/exibirArquivo.aspx?conteudo=JHPL3aK4fDI=

# Métodos atendidos:

* Emissão de NFe (NfeRecepcao)
* Coleta do resultado da emissão de NFe (NfeRetRecepcao)
* Eventos da NFe (RecepcaoEvento)
* Consulta de NFe (NfeConsultaProtocolo )

# Funcionamento:

A NFe é uma forma criada pela receita federal para facilitar a emissão de notas fiscais. Grosseiramente, para que um software emite uma nota, ele deve acessar o webservice do SEFAZ do *ESTADO DO VENDEDOR* e enviar os dados. Se tudo estiver correto, ele receberá um OK.

Para que a NFe passe pela validação, além de todos os dados necessários, há algumas regras que devem ser respeitadas:

* O CNPJ do vendedor não pode ter nenhum problema;
* O CPF ou CNPJ do comprador não pode ter nenhum problema;
* A nota deve ser assinada digitalmente.

Se validado, após a emissão, o Web Service do SEFAZ irá retornar um documento contendo o protocolo de aceitação e a autorização para impressão da nota. Com isso, pode ser feito a impressão do DANFE, que é a representação da nota fiscal em papel A4 comum.

Exemplificando, levando em consideração um ambiente em que:

    O cliente está no estado de São Paulo e deseja emitir uma nota para um cliente do estado de Goiás.

* O primeiro passo é consultar se o CPF ou CNPJ do comprador está hábil para a emissão da NFe (NfeConsultaCadastro);
* Se sim, é feito o envio da NFe (NfeRecepcao);
* Como o método de envio de NFe é assíncrono, é feita a verificação se a NFe foi emitida com sucesso (NfeRetRecepcao);
* Se concluído, pode consultar uma NFe (NfeConsultaProtocolo);
* Pode cancelar uma nota ();
* Pode corrigir uma nota ();

# Mais informações:

http://jornalggn.com.br/blog/luisnassif/o-funcionamento-da-nota-fiscal-eletronica

https://nfe.mps.com.br/Portal/Nfe.aspx

http://www.rt1.com.br/drupal/?q=content/como-funciona-nota-fiscal-eletr%C3%B4nica-nfe

# Como usar essa biblioteca:

'Ainda vou continuar esse README.md'