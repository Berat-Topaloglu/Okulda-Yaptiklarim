package com.example.myapplication;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.example.myapplication.databinding.ActivityKullaniciSayfasiBinding;

public class Kullanici_Sayfasi extends AppCompatActivity {

    private ActivityKullaniciSayfasiBinding binding;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivityKullaniciSayfasiBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
    }
    public void hesap_sil (View view){
        AlertDialog.Builder dialog=new AlertDialog.Builder(Kullanici_Sayfasi.this);
        dialog.setTitle("Hesap Ayarı");
        dialog.setMessage("Hesabı Silmek İstediğinize Emin Misiniz?");
        dialog.setPositiveButton("Evet", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {

            }
        });
        dialog.setNegativeButton("Hayır", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                Toast.makeText(Kullanici_Sayfasi.this, "Hesap Silme İşlemi Reddedildi...", Toast.LENGTH_SHORT).show();
            }
        });
    }
}