package com.example.myapplication;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.example.myapplication.databinding.ActivityKayitSayfasiBinding;
import com.example.myapplication.databinding.ActivityMainBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;

public class Kayit_Sayfasi extends AppCompatActivity {
    private FirebaseAuth mAuth;
    private ActivityKayitSayfasiBinding binding;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivityKayitSayfasiBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        // Initialize Firebase Auth
        mAuth = FirebaseAuth.getInstance();
    }
    public void hesap_olustur (View view){
        if (binding.epostaTxtBox.getText().toString() != null && (binding.sifreTxtBox.getText().toString()==binding.sifreTekrarTxtBox.getText().toString())) {
            mAuth.createUserWithEmailAndPassword(binding.epostaTxtBox.getText().toString(),binding.sifreTxtBox.getText().toString())
                    .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                        @Override
                        public void onComplete(@NonNull Task<AuthResult> task) {
                            if (task.isSuccessful()) {
                                // Sign in success, update UI with the signed-in user's information
                                Toast.makeText(Kayit_Sayfasi.this, "Hesap Oluşturuldu...", Toast.LENGTH_SHORT).show();
                                Intent intent=new Intent(Kayit_Sayfasi.this, MainActivity.class);
                                startActivity(intent);
                            } else {
                                // If sign in fails, display a message to the user.
                                Toast.makeText(Kayit_Sayfasi.this, "Hesap Oluşturma İşlemi Başarısız!!", Toast.LENGTH_SHORT).show();
                            }
                        }

                    });
        }
        else {
            Toast.makeText(Kayit_Sayfasi.this, "Bilgileri kontrol edip tekrar deneyiniz!!", Toast.LENGTH_SHORT).show();
        }
    }
}