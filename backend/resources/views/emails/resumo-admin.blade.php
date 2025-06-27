@component('mail::message')
# Resumo de Vendas do Dia

**Valor Total:** R$ {{ number_format($valorTotal, 2, ',', '.') }}

---

Atenciosamente,
Seu sistema de vendas :)
@endcomponent