package com.example.oda_kontrol_ve_takip_sistemi;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.oda_kontrol_ve_takip_sistemi.databinding.ActivityMainBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class MainActivity extends AppCompatActivity {

    public ActivityMainBinding binding;
    private FirebaseAuth mAuth;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivityMainBinding.inflate(getLayoutInflater());
        EdgeToEdge.enable(this);
        setContentView(binding.getRoot());
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        // Initialize Firebase Auth
        mAuth = FirebaseAuth.getInstance();
        AlertDialog.Builder dialog = new AlertDialog.Builder(MainActivity.this);
        dialog.setTitle("Hoş Geldiniz");
        dialog.setMessage("Yapmak İstediğiniz İşlemi Seçiniz...");
        dialog.setPositiveButton("Yönetici Paneli İçin KUllanım", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                AlertDialog.Builder dialog = new AlertDialog.Builder(MainActivity.this);
                dialog.setTitle("Uygulama Mesajı");
                dialog.setMessage("Yönetici Hesabınız Var Mı?");
                dialog.setPositiveButton("Evet,hesabım var", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        binding.button2.setVisibility(View.INVISIBLE);
                    }
                });
                dialog.setNegativeButton("Hayır,hesabım yok", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        binding.button2.setText("Yönetici Hesabı Ekle");
                        binding.button3.setVisibility(View.INVISIBLE);
                    }
                });
                dialog.show();
            }
        });
        dialog.setNegativeButton("Kullanıcı Paneli İçin Kullanım", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                AlertDialog.Builder dialog = new AlertDialog.Builder(MainActivity.this);
                dialog.setTitle("Uygulama Mesajı");
                dialog.setMessage("Kullanıcı Hesabınız Var Mı?");
                dialog.setPositiveButton("Evet,hesabım var", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        binding.button2.setVisibility(View.INVISIBLE);
                    }
                });
                dialog.setNegativeButton("Hayır,hesabım yok", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        Intent intent = new Intent(MainActivity.this,HesapActivity.class);
                        startActivity(intent);
                        finish();
                    }
                });
                dialog.show();
            }
        });
        dialog.show();
    }
    public void giris(View view){
        if (binding.mailTxtBox.getText() == null && binding.sifreTxtBox.getText() == null) {
            Toast.makeText(this, "Lütfen boş alan bırakmayınız...", Toast.LENGTH_SHORT).show();
        }
        else {
            mAuth.signInWithEmailAndPassword(binding.mailTxtBox.getText().toString(), binding.sifreTxtBox.getText().toString())
                    .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                        @Override
                        public void onComplete(@NonNull Task<AuthResult> task) {
                            if (task.isSuccessful()) {
                                // Sign in success, update UI with the signed-in user's information
                                FirebaseUser user = mAuth.getCurrentUser();
                                Toast.makeText(MainActivity.this, "Authentication successful.",
                                        Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(MainActivity.this, AnaMenuActivity.class);
                                startActivity(intent);
                                finish();

                            } else {
                                // If sign in fails, display a message to the user.
                                Toast.makeText(MainActivity.this, "Authentication failed.",
                                        Toast.LENGTH_SHORT).show();
                            }
                        }
                    });
        }
    }
    public void hesap_ekle (View view){
        Intent intent=new Intent(MainActivity.this,YoneticiActivity.class);
        startActivity(intent);
    }
    public void sifre_unuttum (View view){
        FirebaseAuth auth = FirebaseAuth.getInstance();
        String emailAddress = binding.mailTxtBox.getText().toString();

        auth.sendPasswordResetEmail(emailAddress)
                .addOnCompleteListener(new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        if (task.isSuccessful()) {
                            Toast.makeText(MainActivity.this, "Sıfırlama maili gönderildi...", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }
}