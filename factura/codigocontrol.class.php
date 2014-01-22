<?php 
/**
 * Generacion del codigo de control v7 para impuestos internos de Bolivia
 * 
 * Copyright (c) 2010 Felix A. Carreño B. felix.carreno@gmail.com
 * 
 * Permission is hereby granted, free of charge, to any
 * person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the
 * Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice
 * shall be included in all copies or substantial portions of
 * the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
 * KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
bcscale(0);
class CodigoControl {
        
        // Verhoeff Digit table variables
        var $table_d  = array(
                array(0,1,2,3,4,5,6,7,8,9),
                array(1,2,3,4,0,6,7,8,9,5),
                array(2,3,4,0,1,7,8,9,5,6),
                array(3,4,0,1,2,8,9,5,6,7),
                array(4,0,1,2,3,9,5,6,7,8),
                array(5,9,8,7,6,0,4,3,2,1),
                array(6,5,9,8,7,1,0,4,3,2),
                array(7,6,5,9,8,2,1,0,4,3),
                array(8,7,6,5,9,3,2,1,0,4),
                array(9,8,7,6,5,4,3,2,1,0),
                );
        var $table_p = array(
                array(0,1,2,3,4,5,6,7,8,9),
                array(1,5,7,6,2,8,3,0,9,4),
                array(5,8,0,3,7,9,6,1,4,2),
                array(8,9,1,6,0,4,3,5,2,7),
                array(9,4,5,3,1,2,6,8,7,0),
                array(4,2,8,6,5,7,3,9,0,1),
                array(2,7,9,3,8,0,6,4,1,5),
                array(7,0,4,6,9,1,3,2,5,8),
                );
        var $table_inv = array(0,4,3,2,1,5,6,7,8,9);
        
        var $autorizacion = "";
        var $factura = "";
        var $nitci = "";
        var $fecha = "";
        var $monto = "";
        var $llave = "";
        
        /**
         * @param string $autorizacion: nro de autorizacion de la factura
         * @param string $factura: nro de factura
         * @param string $nitci: nit o ci del cliente
         * @param string $fecha: fecha de la transaccion (Ymd) e.g. para el 10/08/2010: 20100810
         * @param string $monto: monto de la transaccion sin decimales
         * @param string $llave: llave de dosificacion
         * @return string: codigo de control generado
         */
        function CodigoControl($autorizacion, $factura, $nitci, $fecha, $monto, $llave) {
                
                $this->autorizacion = $autorizacion;
                $this->factura = $factura;
                $this->nitci = $nitci;
                $this->fecha = $fecha;
                $this->monto = $monto;
                $this->llave = $llave;
                
        }
        /**
         * Algoritmo de generacion del codigo de control
         */
        public function generar() {
                $autorizacion = $this->autorizacion;
                $factura = $this->factura;
                $nitci = $this->nitci;
                $fecha = $this->fecha;
                $monto = $this->monto;
                $llave = $this->llave;
                // paso 1
                $factura = $this->verhoeff_add_recursive($factura, 2);
                $nitci = $this->verhoeff_add_recursive($nitci, 2);
                $fecha = $this->verhoeff_add_recursive($fecha, 2);
                $monto = $this->verhoeff_add_recursive($monto, 2);
                $suma = bcadd(bcadd(bcadd($factura, $nitci), $fecha), $monto);
                $suma = $this->verhoeff_add_recursive($suma, 5);
                // paso2
                $digitos = "" . substr($suma, -5);
                $digitossum = array();
                $cadenas = array();
                $inicio = 0;
                foreach (str_split($digitos) as $d) {
                        $digitossum[] = $d + 1;
                        $cadenas[] = substr($llave, $inicio, $d + 1);
                        $inicio += $d + 1;
                }
                $autorizacion .= $cadenas[0];
                $factura .= $cadenas[1];
                $nitci .= $cadenas[2];
                $fecha .= $cadenas[3];
                $monto .= $cadenas[4];
                // paso3
                $arc4 = $this->allegedrc4($autorizacion.$factura.$nitci.$fecha.$monto, $llave.$digitos);
                // paso4
                $suma_total = 0;
                $sumas = array_fill(0, 5, 0);
                $strlen_arc4 = strlen($arc4);
                for ($i = 0; $i < $strlen_arc4; $i++) {
                        $x = ord($arc4[$i]);
                        $sumas[$i % 5] += $x;
                        $suma_total += $x;
                }
                // paso5
                $total = "0";
                foreach ($sumas as $i => $sp) {
                        $total = bcadd($total, bcdiv(bcmul($suma_total, $sp), $digitossum[$i]));
                }
                $mensaje = $this->big_base_convert($total);
                return implode("-", str_split($this->allegedrc4($mensaje, $llave.$digitos), 2));
        }
        
        /**
         * Conversion de numeros en base 10 a base 64 o 16
         * @param string $numero: numero a convertir
         * @param string $base: Opcional, convierte a la base indicada
         * @return string: numero convertido
         */
        private function big_base_convert($numero, $base = "64") {
                $dic = array(
                        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
                        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
                        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
                        'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 
                        'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 
                        'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 
                        'y', 'z', '+', '/' );
                $cociente = "1";
                $resto = "";
                $palabra = "";
                while (bccomp($cociente, "0")) {
                        $cociente = bcdiv($numero, $base);
                        $resto = bcmod($numero, $base);
                        $palabra = $dic[0 + $resto] . $palabra;
                        $numero = "" . $cociente;
                }
                return $palabra;
        }
        
        /**
         * Algoritmo Alleged RC4
         * @param string $mensaje: mensaje a cifrar
         * @param string $llave: llave a utilizar para el cifrado
         * @return string: cadena cifrada
         */
        private function allegedrc4($mensaje, $llaverc4) {
                $state = array();
                $x = 0;
                $y = 0;
                $index1 = 0;
                $index2 = 0;
                $nmen = 0;
                $i = 0;
                $cifrado = "";
                
                $state = range(0, 255);
                
                $strlen_llave = strlen($llaverc4);
                $strlen_mensaje = strlen($mensaje);
                for ($i = 0; $i < 256; $i++) {
                        $index2 = ( ord($llaverc4[$index1]) + $state[$i] + $index2 ) % 256;
                        list($state[$i], $state[$index2]) = array($state[$index2], $state[$i]);
                        $index1 = ($index1 + 1) % $strlen_llave;
                }
                for ($i = 0; $i < $strlen_mensaje; $i++) {
                        $x = ($x + 1) % 256;
                        $y = ($state[$x] + $y) % 256;
                        list($state[$x], $state[$y]) = array($state[$y], $state[$x]);
                        // ^ = XOR function
                        $nmen = ord($mensaje[$i]) ^ $state[ ( $state[$x] + $state[$y] ) % 256];
                        $cifrado .= substr("0" . $this->big_base_convert($nmen, "16"), -2);
                }
                return $cifrado;
        }
        /**
         * Digito Verhoeff
         */
        private function calcsum($number) {
                $c = 0;
                $n = strrev($number);
        
                $len = strlen($n);
                for ($i = 0; $i < $len; $i++) {
                        $c = $this->table_d[ $c ][ $this->table_p[ ($i+1) % 8 ][ $n[$i] ] ];
                }
        
                return $this->table_inv[$c];
        }
        private function verhoeff_add_recursive($number, $digits) {
                $temp = $number;
                while ($digits > 0) {
                        $temp .= $this->calcsum($temp);
                        $digits--;
                }
                return $temp;
        }
}
?>