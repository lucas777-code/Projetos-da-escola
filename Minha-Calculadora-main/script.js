const soma =()=> {

    let num1 = parseInt (document.getElementById("num1").value)
    let num2= parseInt (document.getElementById("num2").value)
    let soma= num1+num2
    document.getElementById("resultado").innerText= soma
    }
    const subtração =()=> {

        let num1 = parseInt (document.getElementById("num1").value)
        let num2= parseInt (document.getElementById("num2").value)
        let subtração= num1-num2
        document.getElementById("resultado").innerText= subtração
        }
    const multiplicação =()=> {

            let num1 = parseInt (document.getElementById("num1").value)
            let num2= parseInt (document.getElementById("num2").value)
            let multiplicação= num1*num2
            document.getElementById("resultado").innerText= multiplicação
            }
    const divisão =()=> {

            let num1 = parseInt (document.getElementById("num1").value)
            let num2= parseInt (document.getElementById("num2").value)
            let divisão= num1/num2
            document.getElementById("resultado").innerText= divisão
            }




            function converter() {
                let valor = parseFloat(document.getElementById("valor").value);
                let moedaOrigem = document.getElementById("moedaOrigem").value;
                let moedaDestino = document.getElementById("moedaDestino").value;
            
                // Taxas de câmbio fixas (exemplo)
                const taxaConversaoBRLparaUSD = 5.30;
                const taxaConversaoUSDparaBRL = 1 / taxaConversaoBRLparaUSD;
            
                if (isNaN(valor) || valor <= 0) {
                    document.getElementById("resultado").innerText = "Por favor, insira um valor válido.";
                    return;
                }
            
                let resultado;
            
                // Realizando a conversão de acordo com as moedas selecionadas
                if (moedaOrigem === "BRL" && moedaDestino === "USD") {
                    resultado = valor / taxaConversaoBRLparaUSD;
                } else if (moedaOrigem === "USD" && moedaDestino === "BRL") {
                    resultado = valor * taxaConversaoBRLparaUSD;
                } else {
                    resultado = valor;
                }
            
                // Exibindo o resultado
                document.getElementById("resultado").innerText = `Resultado: ${resultado.toFixed(2)} ${moedaDestino}`;
            }
            

