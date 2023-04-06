package com.mindorks.retrofit.coroutines.data.model

import java.util.*

data class User(
    val idVisiteur: String,
    val mois: Int,
    val nbJustificatifs: Int,
    val montantValide: Float,
    val dateModif: Date,
    val idEtat: String
)