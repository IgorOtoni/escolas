<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/termoCompromisso.blade.php */ ?>
<?php
use App\Libs\html2pdf\HTML2PDF;

$content = "<h1 style='text-align: center;'>Termos de compromisso site Siter</h1>"
    ."<p>Este instrumento constitui um contrato firmado entre "
    ."<b>Site ".$nome.", C.N.P.J. ".$cnpj
    ."</b>, sediada à ".$cep."/".$rua.", nº ".$num
    .", doravante designada apenas como LICENCIADO, e "  
    ."HotSystems Soluções em TI Ltda, C.N.P.J. 13.120.361/0001-13, sediada à Rua 8 de Novembro, 11, lj 2, Centro Norte, Timóteo - MG, doravante designada como HotSystems.</p>"
    ."<h3>I - DOS OBJETIVOS:</h3>"
    ."<p>O objetivo do presente instrumento é a contratação da utilização pelo LICENCIADO do Site Eclesiástico hospedado em nossos servidores, bem como os serviços de manutenção e suporte a ele associados.</p>"
    ."<h3>II - DA EXECUÇÃO DOS SERVIÇOS:</h3>"
    ."<p>Mediante o presente instrumento, o LICENCIADO obtém da HotSystems o direito de utilizar o Site Eclesiástico com as funcionalidades nele implementadas bem como obter a execução do seguinte escopo de serviços:</p>"
    ."<ol type='A'>"
    ."<li>A disponibilização da infraestrutura (servidor, rede, banco de dados, espaço de armazenamento em nuvem, utilizados em conexão via Internet) para processamento do sistema;</li>"
    ."<li>A realização de cópias de segurança (backups diários) dos dados;</li>"
    ."<li>O suporte na utilização e à resolução de problemas (manutenção corretiva) relacionados ao processamento do site.</li>"
    ."</ol>"
    ."<p>Cabe ao LICENCIADO providenciar a infraestrutura local necessária para acesso ao site (Internet, rede, estações de trabalho, etc.) quanto à sua instalação e manutenção. Portanto, a infraestrutura local não faz parte do escopo deste contrato.</p>"
    ."<h3>III – DO SUPORTE TÉCNICO:</h3>"
    ."<p>A HotSystems disponibilizará suporte técnico pelos seguintes meios:</p>"
    ."<ol type='A'>"
    ."<li>Atendentes por telefone, que poderão ser acionados em horário comercial quando se fará o registro da chamada e haverá a tentativa de resolução da dúvida ou problema durante a chamada.</li>"
    ."<li>Atendente ‘online’ pelo sistema Whatsapp</li>"
    ."<li>Atendimento via plataform https://hotsystems.freshdesk.com/ para a abertura de chamados, disponível 24 horas por dia, onde o solicitante poderá se identificar e detalhar a solicitação ou a sua dúvida.</li>"
    ."</ol>"
    ."<h3>IV - DA REMUNERAÇÃO:</h3>"
    ."<p>O LICENCIADO creditará à HotSystems o valor acordado, mensal e antecipadamente.</p>"
    ."<p>Na assinatura deste contrato, a HotSystems fará a primeira cobrança e será assim até o próximo mês de reajuste, março de cada ano.</p>" 
    ."<p>O vencimento das mensalidades se dará no dia 05 (cinco) de cada mês, com tolerância de 05 (cinco) dias, ou seja, dia 10 (dez) de cada mês.</p>" 
    ."<p>O não pagamento da mensalidade até o prazo de tolerância estipulado acarretará ao LICENCIADO o pagamento da multa de 2% (dois por cento) e, decorrido o prazo de 10 (dez) dias do vencimento, aplicar-se-á juros de mora de 2% (dois por cento) ao mês.</p>" 
    ."<p>A cada ano, contados a partir da assinatura do contrato, será realizada a correção monetária da remuneração, aplicando-se o IGP-M acumulado do período.</p>"
    ."<h3>V - DO SIGILO:</h3>"
    ."<p>A HotSystems compromete-se a manter sigilo sobre quaisquer dados e documentos do LICENCIADO de que venha a ter conhecimento ou acesso ou que venha a lhe ser confiado em razão da prestação de serviços.</p>"
    ."<h3>VI - DA VIGÊNCIA</h3>"
    ."<p>O prazo de vigência do presente contrato é indeterminado.</p>"
    ."<p>O LICENCIADO pode requisitar o seu cancelamento quando desejar, porém notificando a HotSystems com 60 dias de antecedência.</p>"
    ."<p>Uma vez cancelado e, desejando restabelecê-lo, o LICENCIADO ficará sujeito às condições vigentes na data do retorno, elaborando-se um novo contrato, e estará sujeito a uma de taxa de retorno a ser estipulada pela HotSystems.</p>"
    ."<h3>VII - CONCLUSÃO</h3>"
    ."<p><b>E por estarem justos e contratados, firmam o presente contrato.</b></p>";

$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
ob_end_clean();
$html2pdf->Output('termo-compromisso.pdf');
?>