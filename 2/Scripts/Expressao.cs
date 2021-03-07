using System.Collections;
using System.Collections.Generic;
using UnityEngine;

[System.Serializable]
public class Expressao {
    
    public int nome;
	public int level;
	public string valor;

	public Expressao (int nome, int level, string valor){
		this.nome = nome;
		this.level = level;
		this.valor = valor;
	}

	public int getNome()
	{
		return this.nome;
	}
}