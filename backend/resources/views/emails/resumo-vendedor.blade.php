@component('mail::message')
# Olá, {{ $dados['vendedor']->nome }}!

Aqui está o seu resumo de vendas do dia:

- **Quantidade de Vendas:** {{ $dados['quantidade'] }}
- **Valor Total:** R$ {{ number_format($dados['valor_total'], 2, ',', '.') }}
- **Comissão Total:** R$ {{ number_format($dados['comissao_total'], 2, ',', '.') }}

Obrigado por suas vendas hoje! Continue assim

Atenciosamente,
Seu sistema de vendas :)
@endcomponent