<?php

/**
 * 
 * @link
 * @copyright
 * @license
 */

namespace nfe\xml;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class Mensagem {

    /**
     * 
     * CÓDIGO RESULTADO DO PROCESSAMENTO DA SOLICITAÇÃO
     * 100 Autorizado o uso da NF-e
     * 101 Cancelamento de NF-e homologado
     * 102 Inutilização de número homologado
     * 103 Lote recebido com sucesso
     * 104 Lote processado
     * 105 Lote em processamento
     * 106 Lote não localizado
     * 107 Serviço em Operação
     * 108 Serviço Paralisado Momentaneamente (curto prazo)
     * 109 Serviço Paralisado sem Previsão
     * 110 Uso Denegado
     * 111 Consulta cadastro com uma ocorrência
     * 112 Consulta cadastro com mais de uma ocorrência
     * 
     * CÓDIGO MOTIVOS DE NÃO ATENDIMENTO DA SOLICITAÇÃO
     * 201 Rejeição: O numero máximo de numeração de NF-e a inutilizar ultrapassou o limite
     * 202 Rejeição: Falha no reconhecimento da autoria ou integridade do arquivo digital
     * 203 Rejeição: Emissor não habilitado para emissão da NF-e
     * 204 Rejeição: Duplicidade de NF-e
     * 205 Rejeição: NF-e está denegada na base de dados da SEFAZ
     * 206 Rejeição: NF-e já está inutilizada na Base de dados da SEFAZ
     * 207 Rejeição: CNPJ do emitente inválido
     * 208 Rejeição: CNPJ do destinatário inválido
     * 09 Rejeição: IE do emitente inválida
     * 210 Rejeição: IE do destinatário inválida
     * 211 Rejeição: IE do substituto inválida
     * 212 Rejeição: Data de emissão NF-e posterior a data de recebimento
     * 213 Rejeição: CNPJ-Base do Emitente difere do CNPJ-Base do Certificado Digital
     * 214 Rejeição: Tamanho da mensagem excedeu o limite estabelecido
     * 215 Rejeição: Falha no schema XML
     * 216 Rejeição: Chave de Acesso difere da cadastrada
     * 217 Rejeição: NF-e não consta na base de dados da SEFAZ
     * 218 Rejeição: NF-e já esta cancelada na base de dados da SEFAZ
     * 219 Rejeição: Circulação da NF-e verificada
     * 220 Rejeição: NF-e autorizada há mais de 7 dias (168 horas)
     * 221 Rejeição: Confirmado o recebimento da NF-e pelo destinatário
     * 222 Rejeição: Protocolo de Autorização de Uso difere do cadastrado
     * 223 Rejeição: CNPJ do transmissor do lote difere do CNPJ do transmissor da consulta
     * 224 Rejeição: A faixa inicial é maior que a faixa final
     * 225 Rejeição: Falha no Schema XML do lote de NFe
     * 226 Rejeição: Código da UF do Emitente diverge da UF autorizadora
     * 227 Rejeição: Erro na Chave de Acesso - Campo Id – falta a literal NFe
     * 228 Rejeição: Data de Emissão muito atrasada
     * 229 Rejeição: IE do emitente não informada
     * 230 Rejeição: IE do emitente não cadastrada
     * 231 Rejeição: IE do emitente não vinculada ao CNPJ
     * 232 Rejeição: IE do destinatário não informada
     * 233 Rejeição: IE do destinatário não cadastrada
     * 234 Rejeição: IE do destinatário não vinculada ao CNPJ
     * 235 Rejeição: Inscrição SUFRAMA inválida
     * 236 Rejeição: Chave de Acesso com dígito verificador inválido
     * 237 Rejeição: CPF do destinatário inválido
     * 238 Rejeição: Cabeçalho - Versão do arquivo XML superior a Versão vigente
     * 239 Rejeição: Cabeçalho - Versão do arquivo XML não suportada
     * 240 Rejeição: Cancelamento/Inutilização - Irregularidade Fiscal do Emitente
     * 241 Rejeição: Um número da faixa já foi utilizado
     * 242 Rejeição: Cabeçalho - Falha no Schema XML
     * 243 Rejeição: XML Mal Formado
     * 244 Rejeição: CNPJ do Certificado Digital difere do CNPJ da Matriz e do CNPJ do Emitente
     * 245 Rejeição: CNPJ Emitente não cadastrado
     * 246 Rejeição: CNPJ Destinatário não cadastrado
     * 247 Rejeição: Sigla da UF do Emitente diverge da UF autorizadora
     * 248 Rejeição: UF do Recibo diverge da UF autorizadora
     * 249 Rejeição: UF da Chave de Acesso diverge da UF autorizadora
     * 250 Rejeição: UF diverge da UF autorizadora
     * 251 Rejeição: UF/Município destinatário não pertence a SUFRAMA
     * 252 Rejeição: Ambiente informado diverge do Ambiente de recebimento
     * 253 Rejeição: Digito Verificador da chave de acesso composta inválida
     * 254 Rejeição: NF-e complementar não possui NF referenciada
     * 255 Rejeição: NF-e complementar possui mais de uma NF referenciada
     * 256 Rejeição: Uma NF-e da faixa já está inutilizada na Base de dados da SEFAZ
     * 257 Rejeição: Solicitante não habilitado para emissão da NF-e
     * 258 Rejeição: CNPJ da consulta inválido
     * 259 Rejeição: CNPJ da consulta não cadastrado como contribuinte na UF
     * 260 Rejeição: IE da consulta inválida
     * 261 Rejeição: IE da consulta não cadastrada como contribuinte na UF
     * 262 Rejeição: UF não fornece consulta por CPF
     * 263 Rejeição: CPF da consulta inválido
     * 264 Rejeição: CPF da consulta não cadastrado como contribuinte na UF
     * 265 Rejeição: Sigla da UF da consulta difere da UF do Web Service
     * 266 Rejeição: Série utilizada não permitida no Web Service
     * 267 Rejeição: NF Complementar referencia uma NF-e inexistente
     * 268 Rejeição: NF Complementar referencia uma outra NF-e Complementar
     * 269 Rejeição: CNPJ Emitente da NF Complementar difere do CNPJ da NF Referenciada
     * 270 Rejeição: Código Município do Fato Gerador: dígito inválido
     * 271 Rejeição: Código Município do Fato Gerador: difere da UF do emitente
     * 272 Rejeição: Código Município do Emitente: dígito inválido
     * 273 Rejeição: Código Município do Emitente: difere da UF do emitente
     * 274 Rejeição: Código Município do Destinatário: dígito inválido
     * 275 Rejeição: Código Município do Destinatário: difere da UF do Destinatário
     * 276 Rejeição: Código Município do Local de Retirada: dígito inválido
     * 277 Rejeição: Código Município do Local de Retirada: difere da UF do Local de Retirada
     * 278 Rejeição: Código Município do Local de Entrega: dígito inválido
     * 279 Rejeição: Código Município do Local de Entrega: difere da UF do Local de Entrega
     * 280 Rejeição: Certificado Transmissor inválido
     * 281 Rejeição: Certificado Transmissor Data Validade
     * 282 Rejeição: Certificado Transmissor sem CNPJ
     * 283 Rejeição: Certificado Transmissor - erro Cadeia de Certificação
     * 284 Rejeição: Certificado Transmissor revogado
     * 285 Rejeição: Certificado Transmissor difere ICP-Brasil
     * 286 Rejeição: Certificado Transmissor erro no acesso a LCR
     * 287 Rejeição: Código Município do FG - ISSQN: dígito inválido
     * 288 Rejeição: Código Município do FG - Transporte: dígito inválido
     * 289 Rejeição: Código da UF informada diverge da UF solicitada
     * 290 Rejeição: Certificado Assinatura inválido
     * 291 Rejeição: Certificado Assinatura Data Validade
     * 292 Rejeição: Certificado Assinatura sem CNPJ
     * 293 Rejeição: Certificado Assinatura - erro Cadeia de Certificação
     * 294 Rejeição: Certificado Assinatura revogado
     * 295 Rejeição: Certificado Assinatura difere ICP-Brasil
     * 296 Rejeição: Certificado Assinatura erro no acesso a LCR
     * 297 Rejeição: Assinatura difere do calculado
     * 298 Rejeição: Assinatura difere do padrão do Projeto
     * 299 Rejeição: XML da área de cabeçalho com codificação diferente de UTF-8
     * 401 Rejeição: CPF do remetente inválido
     * 402 Rejeição: XML da área de dados com codificação diferente de UTF-8
     * 403 Rejeição: O grupo de informações da NF-e avulsa é de uso exclusivo do Fisco
     * 404 Rejeição: Uso de prefixo de namespace não permitido
     * 405 Rejeição: Código do país do emitente: dígito inválido
     * 406 Rejeição: Código do país do destinatário: dígito inválido
     * 407 Rejeição: O CPF só pode ser informado no campo emitente para a NF-e avulsa
     * 409 Rejeição: Campo cUF inexistente no elemento nfeCabecMsg do SOAP Header
     * 410 Rejeição: UF informada no campo cUF não é atendida pelo Web Service
     * 411 Rejeição: Campo versaoDados inexistente no elemento nfeCabecMsg do SOAP Header
     * 420 Rejeição: Cancelamento para NF-e já cancelada
     * 450 Rejeição: Modelo da NF-e diferente de 55
     * 451 Rejeição: Processo de emissão informado inválido
     * 452 Rejeição: Tipo Autorizador do Recibo diverge do Órgão Autorizador
     * 453 Rejeição: Ano de inutilização não pode ser superior ao Ano atual
     * 454 Rejeição: Ano de inutilização não pode ser inferior a 2006
     * 478 Rejeição: Local da entrega não informado para faturamento direto de veículos novos
     * 502 Rejeição: Erro na Chave de Acesso - Campo Id não corresponde à concatenação dos campos correspondentes
     * 503 Rejeição: Série utilizada fora da faixa permitida no SCAN (900-999)
     * 504 Rejeição: Data de Entrada/Saída posterior ao permitido
     * 505 Rejeição: Data de Entrada/Saída anterior ao permitido
     * 506 Rejeição: Data de Saída menor que a Data de Emissão
     * 507 Rejeição: O CNPJ do destinatário/remetente não deve ser informado em operação com o exterior
     * 508 Rejeição: O CNPJ com conteúdo nulo só é válido em operação com exterior
     * 509 Rejeição: Informado código de município diferente de “9999999” para operação com o exterior
     * 510 Rejeição: Operação com Exterior e Código País destinatário é 1058 (Brasil) ou não informado
     * 511 Rejeição: Não é de Operação com Exterior e Código País destinatário difere de 1058 (Brasil)
     * 512 Rejeição: CNPJ do Local de Retirada inválido
     * 513 Rejeição: Código Município do Local de Retirada deve ser 9999999 para UF retirada = EX
     * 514 Rejeição: CNPJ do Local de Entrega inválido
     * 515 Rejeição: Código Município do Local de Entrega deve ser 9999999 para UF entrega = EX
     * 516 Rejeição: Falha no schema XML – inexiste a tag raiz esperada para a mensagem
     * 517 Rejeição: Falha no schema XML – inexiste atributo versao na tag raiz da mensagem
     * 518 Rejeição: CFOP de entrada para NF-e de saída
     * 519 Rejeição: CFOP de saída para NF-e de entrada
     * 520 Rejeição: CFOP de Operação com Exterior e UF destinatário difere de EX
     * 521 Rejeição: CFOP não é de Operação com Exterior e UF destinatário é EX
     * 522 Rejeição: CFOP de Operação Estadual e UF emitente difere UF destinatário.
     * 523 Rejeição: CFOP não é de Operação Estadual e UF emitente igual a UF destinatário.
     * 524 Rejeição: CFOP de Operação com Exterior e não informado NCM
     * 525 Rejeição: CFOP de Importação e não informado dados da DI
     * 526 Rejeição: CFOP de Exportação e não informado Local de Embarque
     * 527 Rejeição: Operação de Exportação com informação de ICMS incompatível
     * 528 Rejeição: Valor do ICMS difere do produto BC e Alíquota
     * 529 Rejeição: NCM de informação obrigatória para produto tributado pelo IPI
     * 530 Rejeição: Operação com tributação de ISSQN sem informar a Inscrição Municipal
     * 531 Rejeição: Total da BC ICMS difere do somatório dos itens
     * 532 Rejeição: Total do ICMS difere do somatório dos itens
     * 533 Rejeição: Total da BC ICMS-ST difere do somatório dos itens
     * 534 Rejeição: Total do ICMS-ST difere do somatório dos itens
     * 535 Rejeição: Total do Frete difere do somatório dos itens
     * 536 Rejeição: Total do Seguro difere do somatório dos itens
     * 537 Rejeição: Total do Desconto difere do somatório dos itens
     * 538 Rejeição: Total do IPI difere do somatório dos itens
     * 539 Rejeição: Duplicidade de NF-e, com diferença na Chave de Acesso [99999999999999999999999999999999999999999]
     * 540 Rejeição: CPF do Local de Retirada inválido
     * 541 Rejeição: CPF do Local de Entrega inválido
     * 542 Rejeição: CNPJ do Transportador inválido
     * 543 Rejeição: CPF do Transportador inválido
     * 544 Rejeição: IE do Transportador inválida
     * 545 Rejeição: Falha no schema XML – versão informada na versaoDados do SOAPHeader diverge da versão da mensagem
     * 546 Rejeição: Erro na Chave de Acesso – Campo Id – falta a literal NFe
     * 547 Rejeição: Dígito Verificador da Chave de Acesso da NF-e Referenciada inválido
     * 548 Rejeição: CNPJ da NF referenciada inválido.
     * 549 Rejeição: CNPJ da NF referenciada de produtor inválido.
     * 550 Rejeição: CPF da NF referenciada de produtor inválido.
     * 551 Rejeição: IE da NF referenciada de produtor inválido.
     * 552 Rejeição: Dígito Verificador da Chave de Acesso do CT-e Referenciado inválido
     * 553 Rejeição: Tipo autorizador do recibo diverge do Órgão Autorizador.
     * 554 Rejeição: Série difere da faixa 0-899
     * 555 Rejeição: Tipo autorizador do protocolo diverge do Órgão Autorizador.
     * 556 Rejeição: Justificativa de entrada em contingência não deve ser informada para tipo de emissão normal.
     * 557 Rejeição: A Justificativa de entrada em contingência deve ser informada.
     * 558 Rejeição: Data de entrada em contingência posterior a data de emissão.
     * 559 Rejeição: UF do Transportador não informada
     * 560 Rejeição: CNPJ base do emitente difere do CNPJ base da primeira NF-e do lote recebido
     * 561 Rejeição: Mês de Emissão informado na Chave de Acesso difere do Mês de Emissão da NF- e
     * 562 Rejeição: Código Numérico informado na Chave de Acesso difere do Código Numérico da NF-e
     * 563 Rejeição: Já existe pedido de Inutilização com a mesma faixa de inutilização
     * 564 Rejeição: Total do Produto / Serviço difere do somatório dos itens
     * 565 Rejeição: Falha no schema XML – inexiste a tag raiz esperada para o lote de NF-e
     * 567 Rejeição: Falha no schema XML – versão informada na versaoDados do SOAPHeader diverge da versão do lote de NF-e
     * 568 Rejeição: Falha no schema XML – inexiste atributo versao na tag raiz do lote de NF-e
     * 
     * MOTIVOS DE DENEGAÇÃO DE USO
     * 301 Uso Denegado: Irregularidade fiscal do emitente
     * 999 Rejeição: Erro não catalogado (informar a mensagem de erro capturado no tratamento da exceção)
     * 
     * @param 
     * @return Boolean
     * @throws
     */
    public function getMensagem() {
        
    }

}